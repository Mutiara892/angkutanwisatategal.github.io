<?php include "dashboard/proses.php";

if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']);
}
if (isset($_SESSION['status'])) {
    $status = $_SESSION['status'];
    unset($_SESSION['status']);
}

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SI Angkutan Tegal Guci</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/app.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <?php
$page = 'index';
include 'components/navbar.php';?>

    <!--awal chowcase-->
    <section class="bg-primary text-white p-5 pt-lg-5 mt-5 text-center text-sm-start">
        <div class="row m-0 ">
            <div class="col-md-8 col-12">
                <h1>Hai Sobat, <b>ACI</b>!</h1>
                <p class="lead my-4">
                    Kami adalah mitra perjalanan Anda untuk menjelajahi keindahan
                    alam dan budaya kota Tegal. Dengan armada kendaraan modern
                    dan destinasi wisata yang beragam, kami siap mengantarkan
                    Anda pada petualangan tak terlupakan.</p>
                <a href="#roadmap" class="btn btn-light btn-lg">Lanjut Yuk!</a>
            </div>
            <div class="col-md-4 col-12">
                <img src="img/5.png" class="img-fluid img-rounded d-none d-md-block">
            </div>
        </div>
    </section>
    <!--akhir chowcase-->

    <!--awal Roadmap -->
    <section id="roadmap" class="m-5">
        <div class="container">
            <div class="row text-center g-4">
                <div class="col-md">
                    <div class="card bg-danger text-light">
                        <div class="card-body text-center">
                            <img src="img/rute.png" width="100px">
                            <h3 class="card-title mb-3">Rute</h3>
                            <p class="card-text">Anda dapat melihat lokasi wisata mana saja yang
                                dilalui oleh angkutan wisata Tegal. Rencanakan perjalanan Anda dengan
                                rute yang telah tersedia.</p>
                            <a href="rute.php" class="btn btn-light">Selengkapnya</a>
                        </div>
                    </div>
                </div>
                <div class="col-md">
                    <div class="card bg-primary text-light">
                        <div class="card-body text-center">
                            <img src="img/jadwal.png" width="100px">
                            <h3 class="card-title mb-3">Jadwal</h3>
                            <p class="card-text">Anda dapat melihat jadwal
                                operasional Angkutan Wisata Tegal di sini. Sesuaikan jadwal angkutan wisata
                                dengan rencana perjalanan Anda di Tegal.</p>
                            <a href="jadwal.php" class="btn btn-light">Selengkapnya</a>
                        </div>
                    </div>
                </div>
                <div class="col-md">
                    <div class="card bg-warning text-light">
                        <div class="card-body text-center">
                            <img src="img/pesan.png" width="100px">
                            <h3 class="card-title mb-3">Reservasi</h3>
                            <p class="card-text">Cocok bagi Anda yang ingin
                                berlibur bersama keluarga tanpa gangguan, lakukan reservasi
                                sekarang untuk perjalanan yang menyenangkan.
                            </p>
                            <a href="dashboard/order/order.php" class="btn btn-light">Selengkapnya</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!--akhir Roadmap-->

    <!--Awal Materi-->
    <div class="row align-items-center bg-primary justify-content-between text-light m-0">
        <div class="col-md">
            <img src="img/materi2.png" alt="" class="img-fluid">
        </div>
        <div class="col-md">
            <h2>Mau Jalan Kemana Hari ini?</h2>
            <p class="lead">Temukan keindahan yang tak terhingga di Tegal,
                dari pesona pantai hingga puncak gunung,
                dari keharmonisan tempat-tempat religi
                hingga destinasi favorit yang memukau hati
                para pelancong. Semua keajaiban itu
                menanti Anda untuk dijelajahi!</p>
            <p>Jelajahi lebih lanjut tentang lokasi-lokasi
                wisata yang menakjubkan dengan sekali klik!</p>
            <a href="rute.php" class="btn btn-light my-3">Selanjutnya</a>
        </div>
    </div>
    <!--Akhir Materi-->

    <!--awal Newsletter-->
    <section class="bg-dark text-light p-5">
        <div class="container">
            <h3 class="mb-3">Saran dan Masukan Anda Sangat Berarti untuk Kami</h3>
            <div class="card">
                <div class="card-body">
                    <form action="review_handler.php" method="post" id="formRate">
                        <div class="row">
                            <div class="col-12 text-center">
                                <label for="" class="">Rating</label>
                                <div class="rate mx-auto text-center">
                                    <input type="radio" id="star5" name="rate" value="5" />
                                    <label for="star5" title="text">5 stars</label>
                                    <input type="radio" id="star4" name="rate" value="4" />
                                    <label for="star4" title="text">4 stars</label>
                                    <input type="radio" id="star3" name="rate" value="3" />
                                    <label for="star3" title="text">3 stars</label>
                                    <input type="radio" id="star2" name="rate" value="2" />
                                    <label for="star2" title="text">2 stars</label>
                                    <input type="radio" id="star1" name="rate" value="1" />
                                    <label for="star1" title="text">1 star</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <label for="masukan">Masukan & Saran</label>
                            <textarea class="form-control" id="masukan" rows="3" required name="masukan"></textarea>
                        </div>

                        <input type="submit" value="Kirim" class="btn btn-primary mt-3">
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!--akhir Newsletter-->

    <?php include 'components/footer.php';?>

    <!--Memanggil Javascript-->
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#formRate').submit(function (e) {
                const rate = $('input[name=rate]:checked').val()
                if (rate === undefined) {
                    alert('Silahkan Memilih Rating Star')
                    e.preventDefault()
                }
            })

            <?php if (isset($status) && isset($message)): ?>
                Swal.fire({
                    title: '<?= ucfirst($status); ?>',
                    text: '<?= $message; ?>',
                    icon: '<?= $status; ?>',
                })
            <?php endif;?>
        });
    </script>
</body>

</html>
