<?php
require_once 'autoload.php';

$client = new MongoDB\Client();
$resto = $client->andrew->employee;

// Fetch all distinct borough values
// $distinctScore= $resto->distinct('Performance Score');

// Filter options
// $scoreFilter = isset($_GET['score']) ? $_GET['score'] : null;
// $ratingFilter = isset($_GET['rating']) ? intval($_GET['rating']) : null;

// MongoDB aggregation pipeline to filter by last grade's score
$pipeline = [];

// Group by restaurant_id and get the last grade's score
$pipeline[] = [
    '$group' => [
        '_id' => '$Employee ID',
        'Employee Name' => ['$first' => '$Employee Name'],
        'Performance Score' => ['$first' => '$Performance Score'],
        'Current Employee Rating' => ['$first' => ['$toInt' => '$Current Employee Rating']],
        'Department' => ['$first' => '$Department'],
        'Position' => ['$first' => '$Position'],
    ],
];

// Match by Performance Score
// if ($scoreFilter) {
$pipeline[] = ['$match' => ['Performance Score' => "Needs Improvement"]];
// }

// Match by Rating less than the given Rating
// if ($ratingFilter) {
$pipeline[] = ['$match' => ['Current Employee Rating' => ['$lte' => 1]]];
// }

$cursor = $resto->aggregate($pipeline);

// Convert MongoDB cursor to PHP array
$employee = iterator_to_array($cursor);

// Convert PHP array to JSON
$employeeJson = json_encode($employee);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rating</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

    <?php
    include 'navhead.php';
    ?>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Lexend&display=swap');

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
    <?php
    include 'navbar.php';
    ?>
    <div class="container mt-5 mb-5">
        <div class="row d-flex justify-content-center">
            <h1 class="text-center">Worst Performance Score and Rating</h1>
        </div>

        <div class="row d-flex justify-content-center mt-3">
            <div class="col-md-10">
                <table id="employeeTable" class="table table-bordered table-striped">
                    <thead class="">
                        <tr>
                            <th>Name</th>
                            <th>Department</th>
                            <th>Position</th>
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
        var employeeData = <?php echo $employeeJson; ?>;

        $(document).ready(function() {
            // Initialize DataTable
            var table = $('#employeeTable').DataTable({
                // scrollX: true,
                scrollCollapse: true,
                searching: false,
                paging: false,
                info: false,
                "columnDefs": [{
                    "className": "dt-center",
                    "targets": "_all"
                }],
                data: employeeData,
                columns: [{
                        data: 'Employee Name',
                        width: '20%'
                    },
                    {
                        data: 'Department',
                        width: '20%',
                    },
                    {
                        data: 'Position',
                        width: '20%',
                    },
                    {
                        data: 'Performance Score',
                        width: '18%',
                    },
                    {
                        data: 'Current Employee Rating',
                        width: '22%',
                    },
                ]
            });
        });
    </script>
</body>

</html>