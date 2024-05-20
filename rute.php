<?php include "dashboard/proses.php"; ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Informasi Angkutan Wisata</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body >

    <?php
  $page = 'rute';
  include('components/navbar.php'); ?>
    <!--awal chowcase-->
    <section class="bg-primary text-white p-5 pt-lg-5 mt-5 text-center text-sm-start">
        <div class="row m-0 ">
            <div class="col-md-8 col-12">
                <h1>Hai Sobat, Si<b>Kuwat</b>!</h1>
                <p class="lead my-4">
                    Kami adalah mitra perjalanan Anda untuk menjelajahi keindahan
                    alam dan budaya kota Tegal. Dengan armada kendaraan modern
                    dan destinasi wisata yang beragam, kami siap mengantarkan
                    Anda pada petualangan tak terlupakan.</p>
                <a href="#roadmap" class="btn btn-light btn-lg">Lanjut Yuk!</a>
            </div>
            <div class="col-md-4 col-12">
                <img src="img/showcase3.png" class="img-fluid img-rounded d-none d-md-block">
            </div>
        </div>
    </section>
    <!--akhir chowcase-->

    <!--Awal Materi-->
    <section id="Rute">
        <div class="row m-0 align-items-center justify-content-between bg-primary text-dark">
            <div class="col py-5 px-0 d-flex flex-column justify-content-center align-items-center text-white">
                <h2>Mau Jalan Kemana Hari ini?</h2>
                <iframe
                    src="https://www.google.com/maps/d/embed?mid=1i5qYWTAzYteZPxJPWrFjJMdaGAHLCoo&ehbc=2E312F&noprof=1"
                    class="rounded w-75" height="1000px"></iframe>
                <a href="dashboard/order/order.php" class="btn btn-light mt-3">Lanjut ke Reservasi</a>
            </div>
        </div>
    </section>
    <!--Akhir Materi-->
    <?php include 'components/footer.php'; ?>

    <script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>


</html>
