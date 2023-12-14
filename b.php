<?php
require 'connect.php';

// Mendapatkan SELECT DISTINCT untuk departemen
$distinctDeptNameQuery = "SELECT DISTINCT dept_name FROM employee ORDER BY dept_name";
$distinctDeptNameResult = $conn->query($distinctDeptNameQuery);
$distinctDeptName = $distinctDeptNameResult->fetchAll(PDO::FETCH_COLUMN);

// Mendapatkan SELECT DISTINCT untuk ras
$distinctRaceQuery = "SELECT DISTINCT race FROM employee ORDER BY race";
$distinctRaceResult = $conn->query($distinctRaceQuery);
$distinctRace = $distinctRaceResult->fetchAll(PDO::FETCH_COLUMN);

// Existing code to initialize filters
$deptNameFilter = isset($_GET['dept_name']) ? $_GET['dept_name'] : '';
$raceFilter = isset($_GET['race']) ? $_GET['race'] : '';

// Check if the filters are arrays; if not, convert them to arrays
$deptNameFilter = is_array($deptNameFilter) ? $deptNameFilter : ($deptNameFilter !== '' ? [$deptNameFilter] : []);
$raceFilter = is_array($raceFilter) ? $raceFilter : ($raceFilter !== '' ? [$raceFilter] : []);

// Modified code to store imploded values in variables
$implodedDeptName = implode(',', $deptNameFilter);
$implodedRace = implode(',', $raceFilter);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Satisfaction</title>

    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- JQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Sweet Alert -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" id="theme-styles">

    <?php
        include 'navhead.php';
    ?>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Lexend&display=swap');

        * {
            font-family: 'Lexend', sans-serif
        }
    </style>

</head>

<body>
    <?php
        include 'navbar.php';
    ?>

    <div class="container mt-5 mb-5 ms-5 me-5">
        <div class="row d-flex">
            <div class="col-md-6">
                <div class="filter-menu">
                    <form method="GET">
                        <!-- Filter by Department -->
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingDepartment">
                                <a class="panel-title accordion-toggle" role="button" data-toggle="collapse" href="#collapseDepartment" aria-expanded="true" aria-controls="collapseDepartment">
                                    Filter by Department
                                </a>
                            </div>
                            <div id="collapseDepartment" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingDepartment">
                                <div class="panel-body">
                                    <?php
                                    foreach ($distinctDeptName as $deptNameOption) {
                                        $isChecked = is_array($deptNameFilter) && in_array($deptNameOption, $deptNameFilter) ? 'checked' : '';
                                        echo "<div class='checkbox'><label><input type='checkbox' name='dept_name[]' value='$deptNameOption' $isChecked>$deptNameOption</label></div>";
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>

                        <!-- Filter by Race -->
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingRace">
                                <a class="panel-title accordion-toggle" role="button" data-toggle="collapse" href="#collapseRace" aria-expanded="true" aria-controls="collapseRace">
                                    Filter by Race
                                </a>
                            </div>
                            <div id="collapseRace" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingRace">
                                <div class="panel-body">
                                    <?php
                                    foreach ($distinctRace as $raceOption) {
                                        $isChecked = is_array($raceFilter) && in_array($raceOption, $raceFilter) ? 'checked' : '';
                                        echo "<div class='checkbox'><label><input type='checkbox' name='race[]' value='$raceOption' $isChecked>$raceOption</label></div>";
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary mb-5">Apply Filters</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- enable collapse -->
    <script>
        jQuery(document).ready(function ($) {
            $('.collapse').collapse();
        });
    </script>


    <div class="container mt-5 mb-5 me-5">
        <div style="text-align: center" class="row d-flex justify-content-center">
            <h1>Satisfaction Score by Department and Race</h1>

            <div class="row">
                <div>
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-10">
                            <table id="tablePendapatan" class="table table-bordered table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th scope="col" class="center-contents">Department</th>
                                        <th scope="col" class="center-contents">Race</th>
                                        <th scope="col" class="center-contents">Average Satisfaction Score</th>
                                    </tr>
                                </thead>
                                <tbody class="center-contents">
                                    <?php
                                    $survey = "SELECT employee.dept_name, employee.race, AVG(survey.satisfaction_score) AS avg_satisfaction_score
                                                FROM employee
                                                JOIN survey ON employee.emp_id = survey.emp_id
                                                WHERE (:deptNameFilter = '' OR employee.dept_name IN (:deptNameFilter))
                                                AND (:raceFilter = '' OR employee.race IN (:raceFilter))
                                                GROUP BY employee.dept_name, employee.race";
                                    $stmt = $conn->prepare($survey);
                                    $stmt->bindParam(':deptNameFilter', $implodedDeptName, PDO::PARAM_STR);
                                    $stmt->bindParam(':raceFilter', $implodedRace, PDO::PARAM_STR);
                                    $stmt->execute();
                                    $result = $stmt->fetchAll();
                                    foreach ($result as $data) :
                                    ?>
                                        <tr>
                                            <td><?= $data['dept_name'] ?></td>
                                            <td><?= $data['race'] ?></td>
                                            <td><?= number_format($data['avg_satisfaction_score'], 2) ?></td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#tablePendapatan').DataTable();
        });
    </script>
</body>
</html>
