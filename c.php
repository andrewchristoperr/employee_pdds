<?php
require 'connect.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Training</title>

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
                    <h1>Comparation Average Training Cost and Cost/Day</h1>
                </div>
                <div class="row">
                    <div>
                        <div class="row d-flex justify-content-center">
                            <div class="col-md-10">
                                <table id="tablePendapatan" class="table table-bordered table-striped" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="center-contents">Training Program</th>
                                            <th scope="col" class="center-contents">Average Training Duration</th>
                                            <th scope="col" class="center-contents">Average Training Cost/Day</th>
                                            <th scope="col" class="center-contents">Average Training Cost</th>
                                        </tr>
                                    </thead>
                                    <tbody class="center-contents">
                                        <?php
                                        $training =  "SELECT trainingprogram_name, AVG(training_duration) AS avg_training_dur,
                                                        AVG(training_cost) AS avg_training_cost,
                                                        AVG(training_cost/training_duration) AS avg_costperday
                                                        FROM training
                                                        GROUP BY trainingprogram_name";
                                        $result = $conn->query($training)->fetchAll();
                                        foreach ($result as $data) :
                                        ?>
                                            <tr>
                                                <td><?= $data['trainingprogram_name'] ?></td>
                                                <td><?= number_format($data['avg_training_dur'], 2) ?></td>
                                                <td><?= number_format($data['avg_costperday'], 2) ?></td>
                                                <td><?= number_format($data['avg_training_cost'], 2) ?></td>
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
    <script>
        $(document).ready(function() {
            $('#tablePendapatan').DataTable();
        });
    </script>
</body>
</html>
