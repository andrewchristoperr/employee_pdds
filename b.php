<?php
require 'connect.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

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
        <div class="row">
            <div style="text-align: center">
                <div class="section-title" data-aos="fade-in" data-aos-delay="100">
                    <h2>Satisfaction Score by Dept and Race</h2>
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
                                        $survey =  "SELECT employee.dept_name, employee.race, AVG(survey.satisfaction_score) AS avg_satisfaction_score
                                                        FROM employee
                                                        JOIN survey ON employee.emp_id = survey.emp_id
                                                        GROUP BY employee.dept_name, employee.race";
                                        $result = $conn->query($survey)->fetchAll();
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
    </div>




</body>

</html>
