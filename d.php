<?php
require_once 'autoload.php';

$client = new MongoDB\Client();
$resto = $client->andrew->recruitment;

// Fetch all distinct values for job title and education level
$distinctJobTitle = $resto->distinct('Position');
$distinctEducationLevel = $resto->distinct('Education Level');

// Filter options
$jobTitleFilter = isset($_GET['jobTitle']) ? $_GET['jobTitle'] : [];
$educationLevelFilter = isset($_GET['educationLevel']) ? array_map('htmlspecialchars_decode', $_GET['educationLevel']) : [];
$yearsFilter = isset($_GET['years']) ? intval($_GET['years']) : null;

// MongoDB aggregation pipeline to filter by last grade's score
$pipeline = [];

// Group by job title, education level, and years of experience
$pipeline[] = [
    '$group' => [
        '_id' => ['Job Title' => '$Position', 'Education Level' => '$Education Level', 'Years of Experience' => '$Years of Experience'],
        'Position' => ['$first' => '$Position'],
        'Education Level' => ['$first' => '$Education Level'],
        'Years of Experience' => ['$first' => ['$toInt' => '$Years of Experience']],
        'Salary Desired' => ['$avg' => ['$toInt' => '$Salary Desired']],
    ],
];

// Match by selected job titles
if (!empty($jobTitleFilter)) {
    $pipeline[] = ['$match' => ['Position' => ['$in' => $jobTitleFilter]]];
}

// Match by selected education levels
if (!empty($educationLevelFilter)) {
    $pipeline[] = ['$match' => ['Education Level' => ['$in' => $educationLevelFilter]]];
}

// Match by years of experience less than the given years
if ($yearsFilter) {
    $pipeline[] = ['$match' => ['Years of Experience' => $yearsFilter]];
}

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
    <title>Desired Salary</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0"></script>

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

        /* (1) Change buttons (excluding active or disabled) */
        /* .pagination>li>a {
            background-color: #ADD8E6;
            border-color: #F0F8FF;
            color: #000000;
        } */

        /* (2) Change disabled buttons*/
        /* .pagination>.disabled>a,
        .pagination>.disabled>a:hover,
        .pagination>.disabled>a:focus {
            background-color: #E0FFFF;
            border-color: #F0F8FF;
            color: #000000;
        } */

        /* (3) Change active or hover button color*/
        /* .pagination>.active>a,
        .pagination>.active>a:hover,
        .pagination>.active>a:focus,
        .pagination>li>a:hover,
        .pagination>li>a:focus {
            background-color: #87CEFA;
            border-color: #F0F8FF;
            color: #000000;
        } */
    </style>

    <!-- slicer -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <style>
        body {
            background-color: #f0f0f0;
        }

        .containerr {
            width: auto;
        }

        .primary {
            min-height: 800px;
        }

        /*** Accordion Toggles ***/
        .panel-heading {
            position: relative;
        }

        .panel-heading .accordion-toggle:after {
            font-family: 'Glyphicons Halflings';
            content: "\e260";
            position: absolute;
            right: 16px;
        }

        .panel-heading .accordion-toggle.collapsed:after {
            font-family: 'Glyphicons Halflings';
            content: "\e259";
        }

        /*** Filter Menu ***/
        /* Panels */
        .filter-menu {
            min-width: 300px;
        }

        .filter-menu .panel {
            border-radius: 0;
            border: 1px solid #eeeeee;
        }

        .filter-menu .panel-heading {
            background: #fff;
            padding: 0;
        }

        .filter-menu .panel-title {
            color: #333333;
            font-weight: bold;
            display: block;
            padding: 16px;
        }

        .filter-menu a.panel-title {
            color: #333333;
        }

        .filter-menu a.panel-title:hover,
        .filter-menu a.panel-title:focus {
            color: #333333;
            text-decoration: none;
        }

        .filter-menu .panel-body {
            padding: 16px;
        }

        /* Inner Panels */
        .filter-menu .panel-group {
            margin: -16px;
        }

        .filter-menu .panel-group .panel-title {
            background: #eee;
            transition: color, 0.5s, ease;
        }

        .filter-menu .panel-group .panel-title:hover {
            color: #333333;
            text-decoration: none;
            background: #777777;
        }

        .filter-menu .panel-group .panel+.panel {
            margin-top: 0;
        }

        /*** Filter Menu - Mobile ***/
        /* Panels - Mobile */
        .filter-menu.mobile .btn-link {
            color: #f9f9f9;
        }

        .filter-menu.mobile hr {
            margin-top: 0;
            border-top-color: #4B6473;
        }

        .filter-menu.mobile .panel-group .panel-heading+.panel-collapse>.panel-body {
            border-color: #4B6473;
        }

        .filter-menu.mobile .panel {
            border-color: #4B6473;
            background: #30404a;
            color: #f9f9f9;
        }

        .filter-menu.mobile .panel-heading {
            background: #30404a;
        }

        .filter-menu.mobile a.panel-title {
            color: #f9f9f9;
        }

        .filter-menu.mobile a.panel-title:hover {
            color: #f9f9f9;
        }

        .filter-menu.mobile .panel-group .panel {
            border-color: #4B6473;
        }

        .filter-menu.mobile .panel-group .panel-title {
            background: #3f5460;
        }

        .filter-menu.mobile .panel-group .panel-title:hover {
            color: #f9f9f9;
            background: #30404a;
        }
    </style>
</head>

<body>
    <?php
    include 'navbar.php';
    ?>

    <div class="containerr container mt-5 mb-5 ms-5 me-5">
        <div class="row d-flex">
            <div class="col-md-6">
                <div class="filter-menu">
                    <form method="GET">
                        <!-- Filter by Job Title -->
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingJobTitle">
                                <a class="panel-title accordion-toggle" role="button" data-toggle="collapse" href="#collapseJobTitle" aria-expanded="true" aria-controls="collapseJobTitle">
                                    Filter by Job Title
                                </a>
                            </div>
                            <div id="collapseJobTitle" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingJobTitle">
                                <div class="panel-body">
                                    <?php
                                    foreach ($distinctJobTitle as $jobTitleOption) {
                                        $checked = (in_array($jobTitleOption, $jobTitleFilter)) ? 'checked' : '';
                                        echo "<div class='form-check'><input class='form-check-input' type='checkbox' name='jobTitle[]' value='$jobTitleOption' $checked><label class='form-check-label'>$jobTitleOption</label></div>";
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>

                        <!-- Filter by Education Levels -->
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingEducationLevels">
                                <a class="panel-title accordion-toggle" role="button" data-toggle="collapse" href="#collapseEducationLevels" aria-expanded="true" aria-controls="collapseEducationLevels">
                                    Filter by Education Levels
                                </a>
                            </div>
                            <div id="collapseEducationLevels" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingEducationLevels">
                                <div class="panel-body">
                                    <?php
                                    foreach ($distinctEducationLevel as $educationLevelOption) {
                                        $encodedOption = htmlspecialchars($educationLevelOption, ENT_QUOTES, 'UTF-8');
                                        $checked = (in_array($encodedOption, $educationLevelFilter)) ? 'checked' : '';
                                        echo "<div class='form-check'><input class='form-check-input' type='checkbox' name='educationLevel[]' value='$encodedOption' $checked><label class='form-check-label'>$educationLevelOption</label></div>";
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>

                        <!-- Filter by Years of Experience -->
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingYears">
                                <a class="panel-title accordion-toggle" role="button" data-toggle="collapse" href="#collapseYears" aria-expanded="true" aria-controls="collapseYears">
                                    Filter by Years of Experience
                                </a>
                            </div>
                            <div id="collapseYears" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingYears">
                                <div class="panel-body">
                                    <label style="font-size: small;">Years of Experience(Less Than Equal):</label>
                                    <input type="number" id="years" name="years" class="form-control mb-3" placeholder="Enter Years of Experience" value="<?= $yearsFilter ?>">
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary mb-5">Apply Filters</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-5 mb-5" style="margin-right: 20px;">
        <div class="row d-flex justify-content-center">
            <h1 class="text-center">Applicant</h1>


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
                    scrollX: true,
                    scrollCollapse: true,
                    searching: false,
                    // paging: false,
                    // info: false,
                    "columnDefs": [{
                        "className": "dt-center",
                        "targets": "_all"
                    }],
                    color: "red",
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