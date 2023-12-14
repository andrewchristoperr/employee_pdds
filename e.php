<?php
require 'connect.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Salary</title>

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
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <?php
    include 'navhead.php';
    ?>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Lexend&display=swap');

        * {
            font-family: 'Lexend', sans-serif
        }
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

    <div class="container mt-5 mb-5">
        <div class="row">

            <div class="section-title" data-aos="fade-in" data-aos-delay="100">
                <h1 class="text-center">Comparation Salary Given dan Salary Desired</h1>
            </div>
            <div class="row">
                <div>
                    <div class="row d-flex justify-content-center mt-5">
                        <div class="col-md-10">
                            <canvas id="lineChart" width="400" height="200"></canvas>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-10">
                            <table id="tablePendapatan" class="table table-bordered table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th scope="col" class="center-contents">Position</th>
                                        <th scope="col" class="center-contents">Average Salary</th>
                                        <th scope="col" class="center-contents">Average Salary Desired</th>
                                    </tr>
                                </thead>
                                <tbody class="center-contents">
                                    <?php
                                    $avgsalary =  "SELECT employee.position, AVG(employee.salary) AS avg_salary, AVG(recruitment.salary_desired) AS avg_salary_desired
                                                        FROM employee
                                                        JOIN recruitment ON employee.position = recruitment.position
                                                        GROUP BY employee.position";
                                    $result = $conn->query($avgsalary)->fetchAll();
                                    foreach ($result as $data) :
                                    ?>
                                        <tr>
                                            <td><?= $data['position'] ?></td>
                                            <td><?= number_format($data['avg_salary'], 2) ?></td>
                                            <td><?= number_format($data['avg_salary_desired'], 2) ?></td>
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
            $('#tablePendapatan').DataTable({
                "columnDefs": [{
                    "className": "dt-center",
                    "targets": "_all"
                }],
            });
        });
    </script>
    <script>
        // Use the fetched JSON data
        var salaryData = <?php echo json_encode($result); ?>;

        $(document).ready(function() {
            // Prepare data for the line chart
            var chartData = {
                labels: salaryData.map(function(item) {
                    return item['position'];
                }),
                datasets: [{
                    label: 'Average Salary',
                    data: salaryData.map(function(item) {
                        return item['avg_salary'];
                    }),
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    fill: false,
                }, {
                    label: 'Average Desired Salary',
                    data: salaryData.map(function(item) {
                        return item['avg_salary_desired'];
                    }),
                    borderColor: 'rgba(255, 99, 132, 1)',
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    fill: false,
                }]
            };

            // Get the canvas element
            var ctx = document.getElementById('lineChart').getContext('2d');

            // Create the line chart
            var lineChart = new Chart(ctx, {
                type: 'line',
                data: chartData,
                options: {
                    scales: {
                        x: {
                            ticks: {
                                autoSkip: false,
                                maxRotation: 45,
                                minRotation: 45
                            }
                        },
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>

</body>

</html>