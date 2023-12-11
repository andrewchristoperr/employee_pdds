<?php
require_once 'autoload.php';

$client = new MongoDB\Client();
$resto = $client->andrew->recruitment;

// Fetch all distinct borough values
$distinctJobTitle = $resto->distinct('Position');
$distinctEducationLevel = $resto->distinct('Education Level');

// Filter options
$jobTitleFilter = isset($_GET['jobTitle']) ? $_GET['jobTitle'] : null;
$educationLevelFilter = isset($_GET['educationLevel']) ? $_GET['educationLevel'] : null;
$yearsFilter = isset($_GET['years']) ? intval($_GET['years']) : null;

// MongoDB aggregation pipeline to filter by last grade's score
$pipeline = [];

// Group by restaurant_id and get the last grade's score
$pipeline[] = [
    '$group' => [
        '_id' => ['Job Title' => '$Position', 'Education Level' => '$Education Level', 'Years of Experience' => '$Years of Experience'],
        'Position' => ['$first' => '$Position'],
        'Education Level' => ['$first' => '$Education Level'],
        'Years of Experience' => ['$first' => ['$toInt' => '$Years of Experience']],
        'Salary Desired' => ['$avg' => ['$toInt' => '$Salary Desired']],
    ],
];

// Match by jobtitle
if ($jobTitleFilter) {
    $pipeline[] = ['$match' => ['Position' => $jobTitleFilter]];
}

// Match by education level (case-insensitive)
if ($educationLevelFilter) {
    // $pipeline[] = ['$match' => ['Education Level' => ['$regex' => $educationLevelFilter, '$options' => 'i']]];
    $pipeline[] = ['$match' => ['Education Level' => $educationLevelFilter]];
}




// Match by years of experience less than the given years
if ($yearsFilter) {
    $pipeline[] = ['$match' => ['Years of Experience' => ['$lt' => $yearsFilter]]];
}

// var_dump($pipeline);
$cursor = $resto->aggregate($pipeline);

// Convert MongoDB cursor to PHP array
$applicant = iterator_to_array($cursor);

// Convert PHP array to JSON
$applicantJson = json_encode($applicant);

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

    <?php
        include 'navhead.php';
    ?>

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
    <?php
        include 'navbar.php';
    ?>
    <div class="container mt-5 mb-5">
        <div class="row d-flex justify-content-center">
            <h1 class="text-center">Applicant</h1>
            <div class="col-md-8">
                <form method="GET">
                    <label>Filter by Job Title:</label>
                    <select id="jobTitleFilter" name="jobTitle" class="form-select mb-3">
                        <option value="">All Job Title</option>
                        <?php
                        foreach ($distinctJobTitle as $jobTitleOption) {
                            $selected = ($jobTitleOption == $jobTitleFilter) ? 'selected' : '';
                            echo "<option value='$jobTitleOption' $selected>$jobTitleOption</option>";
                        }
                        ?>
                    </select>

                    <label>Filter by Education Level:</label>
                    <select id="educationLevelFilter" name="educationLevel" class="form-select mb-3">
                        <option value="">All Education Levels</option>
                        <?php
                        foreach ($distinctEducationLevel as $educationLevelOption) {
                            // Use htmlspecialchars to encode special characters
                            $encodedOption = htmlspecialchars($educationLevelOption, ENT_QUOTES, 'UTF-8');

                            $selected = ($educationLevelOption == $educationLevelFilter) ? 'selected' : '';
                            echo "<option value='$encodedOption' $selected>$encodedOption</option>";
                        }
                        ?>
                    </select>


                    <label>Years of Experience(Less Than Equal):</label>
                    <input type="number" id="years" name="years" class="form-control mb-3" placeholder="Enter Years of Experience" value="<?= $yearsFilter ?>">


                    <button type="submit" class="btn btn-primary mb-5">Apply Filters</button>
                </form>
            </div>


            <div class="row d-flex justify-content-center">
                <div class="col-md-10">
                    <table id="applicantTable" class="table table-bordered table-striped">
                        <thead class="">
                            <tr>
                                <th>Job Title</th>
                                <th>Education Level</th>
                                <th>Years of Experience</th>
                                <th>Average Desired Salary</th>
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
            var applicantData = <?php echo $applicantJson; ?>;

            $(document).ready(function() {
                // Initialize DataTable
                var table = $('#applicantTable').DataTable({
                    // scrollX: true,
                    scrollCollapse: true,
                    // searching: false,
                    data: applicantData,
                    columns: [{
                            data: 'Position',
                            width: '20%',
                        },
                        {
                            data: 'Education Level',
                            width: '20%',
                        },
                        {
                            data: 'Years of Experience',
                            width: '20%',
                        },
                        {
                            data: 'Salary Desired',
                            width: '20%',
                        },
                    ]
                });
            });
        </script>
</body>

</html>
