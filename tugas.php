<?php
require_once 'autoload.php';

$client = new MongoDB\Client();
$resto = $client->andrew->restaurants;

// Fetch all distinct borough values
$distinctBoroughs = $resto->distinct('borough');

// Filter options
$boroughFilter = isset($_GET['borough']) ? $_GET['borough'] : null;
$cuisineFilter = isset($_GET['cuisine']) ? $_GET['cuisine'] : null;
$scoreFilter = isset($_GET['score']) ? intval($_GET['score']) : null;

// MongoDB aggregation pipeline to filter by last grade's score
$pipeline = [];

// Match by borough
if ($boroughFilter) {
    $pipeline[] = ['$match' => ['borough' => $boroughFilter]];
}

// Match by cuisine using case-insensitive regex for partial matching
if ($cuisineFilter) {
    $pipeline[] = [
        '$match' => [
            'cuisine' => [
                '$regex' => $cuisineFilter,
                '$options' => 'i',
            ],
        ],
    ];
}

// Unwind the grades array
$pipeline[] = ['$unwind' => '$grades'];

// Group by restaurant_id and get the last grade's score
$pipeline[] = [
    '$group' => [
        '_id' => '$restaurant_id',
        'name' => ['$first' => '$name'],
        'address' => ['$first' => '$address'],
        'borough' => ['$first' => '$borough'],
        'cuisine' => ['$first' => '$cuisine'],
        'grade' => ['$first' => '$grades.grade'],
        'last_score' => ['$first' => '$grades.score'],
    ],
];

// Match by last grade's score less than the given score
if ($scoreFilter) {
    $pipeline[] = ['$match' => ['last_score' => ['$lt' => $scoreFilter]]];
}

$cursor = $resto->aggregate($pipeline);

// Convert MongoDB cursor to PHP array
$restaurants = iterator_to_array($cursor);

// Convert PHP array to JSON
$restaurantsJson = json_encode($restaurants);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

    <style>
        .container {
            border: 1px solid black;
            border-radius: 15px;
            padding-top: 25px;
            padding-bottom: 25px;
            box-shadow: 0px 0px 7px #000000;
        }
    </style>

</head>

<body>
    <div class="container mt-5 mb-5">
        <div class="row d-flex justify-content-center">
            <h1 class="text-center">Restaurant</h1>
            <div class="col-md-8">
                <form method="GET">
                    <label for="boroughFilter">Filter by Borough:</label>
                    <select id="boroughFilter" name="borough" class="form-select mb-3" aria-label="Filter by Borough">
                        <option value="">All Boroughs</option>
                        <?php
                        foreach ($distinctBoroughs as $boroughOption) {
                            $selected = ($boroughOption == $boroughFilter) ? 'selected' : '';
                            echo "<option value='$boroughOption' $selected>$boroughOption</option>";
                        }
                        ?>
                    </select>

                    <label for="cuisineFilter">Filter by Cuisine:</label>
                    <input type="text" id="cuisineFilter" name="cuisine" class="form-control mb-3" placeholder="Enter Cuisine" value="<?= $cuisineFilter ?>">

                    <label for="scoreFilter">Filter by Last Grade's Score (Less than):</label>
                    <input type="number" id="scoreFilter" name="score" class="form-control mb-3" placeholder="Enter Score" value="<?= $scoreFilter ?>">

                    <button type="submit" class="btn btn-primary mb-5">Apply Filters</button>
                </form>
            </div>
        </div>

        <div class="row d-flex justify-content-center">
            <div class="col-md-10">
                <table id="restaurantTable" class="table table-bordered table-striped">
                    <thead class="">
                        <tr>
                            <th>id</th>
                            <th>Name</th>
                            <!-- <th>Address</th>
                            <th>Borough</th>
                            <th>Cuisine</th>
                            <th>Grade</th>
                            <th>Last Grade's Score</th> -->
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <script>
        // Use the fetched JSON data
        var restaurantsData = <?php echo $restaurantsJson; ?>;

        $(document).ready(function() {
            // Initialize DataTable
            var table = $('#restaurantTable').DataTable({
                scrollX: true,
                scrollCollapse: true,
                searching: false,
                data: restaurantsData,
                columns: [{
                        data: '_id',
                        width: '8%'
                    },
                    {
                        data: 'name',
                        width: '25%'
                    },
                    // {
                    //     data: 'address.street',
                    //     width: '20%',
                    //     defaultContent: ''
                    // },
                    // {
                    //     data: 'borough',
                    //     width: '15%'
                    // },
                    // {
                    //     data: 'cuisine',
                    //     width: '15%'
                    // },
                    // {
                    //     data: 'grade',
                    //     width: '5%'
                    // },
                    // {
                    //     data: 'last_score',
                    //     width: '15%'
                    // },
                ]
            });
        });
    </script>
</body>

</html>