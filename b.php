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

// Set the filter values based on the submitted form values
$deptNameFilter = isset($_GET['dept_name']) ? $_GET['dept_name'] : '';
$raceFilter = isset($_GET['race']) ? $_GET['race'] : '';
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

    <div class="container mt-5 mb-5">
        <div style="text-align: center" class="row d-flex justify-content-center">
            <h1>Satisfaction Score by Department and Race</h1>
            <div class="col-md-8">
                <form method="GET">
                    <label>Filter by Department:</label>
                    <select id="deptNameFilter" name="dept_name" class="form-select mb-3">
                        <option value="">All Departments</option>
                        <?php
                        foreach ($distinctDeptName as $deptNameOption) {
                            $selected = ($deptNameOption == $deptNameFilter) ? 'selected' : '';
                            echo "<option value='$deptNameOption' $selected>$deptNameOption</option>";
                        }
                        ?>
                    </select>

                    <label>Filter by Race:</label>
                    <select id="raceFilter" name="race" class="form-select mb-3">
                        <option value="">All Races</option>
                        <?php
                        foreach ($distinctRace as $raceOption) {
                            $selected = ($raceOption == $raceFilter) ? 'selected' : '';
                            echo "<option value='$raceOption' $selected>$raceOption</option>";
                        }
                        ?>
                    </select>

                    <button type="submit" class="btn btn-primary mb-5">Apply Filters</button>
                </form>
            </div>

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
                                                WHERE (:deptNameFilter = '' OR employee.dept_name = :deptNameFilter)
                                                AND (:raceFilter = '' OR employee.race = :raceFilter)
                                                GROUP BY employee.dept_name, employee.race";
                                    $stmt = $conn->prepare($survey);
                                    $stmt->bindParam(':deptNameFilter', $deptNameFilter);
                                    $stmt->bindParam(':raceFilter', $raceFilter);
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
