<?php
require_once 'autoload.php';

$client = new MongoDB\Client();
$resto = $client->andrew->employee;

// Fetch all distinct borough values
$distinctScore= $resto->distinct('Performance Score');

// Filter options
$scoreFilter = isset($_GET['score']) ? $_GET['score'] : null;
$ratingFilter = isset($_GET['rating']) ? intval($_GET['rating']) : null;

// MongoDB aggregation pipeline to filter by last grade's score
$pipeline = [];

// Group by restaurant_id and get the last grade's score
$pipeline[] = [
    '$group' => [
        '_id' => '$Employee ID',
        'name' => ['$first' => '$Employee Name'],
        'score' => ['$first' => '$Performance Score'],
        'current_employee_rating' => ['$first' => '$Current Employee Rating'],
    ],
];

// Match by last grade's score less than the given score
if ($scoreFilter) {
    $pipeline[] = ['$match' => ['score' => ['$lt' => $scoreFilter]]];
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
                    <label>Filter by Performance Score:</label>
                    <select id="score" name="score" class="form-select mb-3">
                        <option value="">All Performance Score</option>
                        <?php
                        foreach ($distinctScore as $ScoreOption) {
                            $selected = ($ScoreOption == $scoreFilter) ? 'selected' : '';
                            echo "<option value='$ScoreOption' $selected>$ScoreOption</option>";
                        }
                        ?>
                    </select>

                    <label for="cuisineFilter">Filter by Rating (Less Than)</label>
                    <input type="text" id="cuisineFilter" name="cuisine" class="form-control mb-3" placeholder="Enter Cuisine" value="">

                    <button type="submit" class="btn btn-primary mb-5">Apply Filters</button>
                </form>
            </div>
        </div>

        <div class="row d-flex justify-content-center">
            <div class="col-md-10">
                <table id="restaurantTable" class="table table-bordered table-striped">
                    <thead class="">
                        <tr>
                            <th>Name</th>
                            <th>Performance Score</th>
                            <th>Current Employee Rating</th>
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
                        data: 'name',
                        width: '28%'
                    },
                    {
                        data: 'score',
                        width: '20%',
                    },
                    {
                        data: 'current_employee_rating',
                        width: '20%',
                    },
                ]
            });
        });
    </script>
</body>

</html>