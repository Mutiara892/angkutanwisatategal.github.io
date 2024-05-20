<?php
include "../proses.php";
// Cek Status Login
if (!isset($_SESSION["login"])) {
    header("Location: ../pages/login.php");
    exit;
}
// End Of Cek Status Login
$id = $_SESSION["login"];
$db = new Connect_db();
$result = $db->db_From_Id("SELECT * FROM user WHERE id = '$id'");
$lokasi = $db->db_From_Id("SELECT * FROM lokasi");

// Upload Pesanan
if (isset($_POST["pesan"])) {
    $user_id = $_POST['user_id'];
    $kode_order = $_POST["kode_order"];
    $tanggal_order = $_POST["tanggal_order"];
    $total_pembayaran = $_POST["total_pembayaran"];
    $order_type = $_POST["order_type"];
    $titik_berangkat = $_POST["berangkat"];
    $tujuan = $_POST["tujuan"];
    $jadwal_berangkat = $_POST["jadwal_berangkat"];
    $kursi = $_POST["kursi"];
    $metode_pembayaran = $_POST["metode_pembayaran"];
    $bukti_transfer = $db->upload_Gambar($_FILES["gambar"]);

    $db->set_Pesanan($user_id, $kode_order, $order_type, $tanggal_order, $total_pembayaran, $bukti_transfer, $jadwal_berangkat, $titik_berangkat, $tujuan, $kursi, $metode_pembayaran);
}
// End Of Upload Pesanan

// id tiket acak
$id_tiket_acak = time() . mt_rand(00, 99);
// end of id tiket acak

// Cek Status Login
if (!isset($_SESSION["login"])) {
    header("Location: ../pages/login.php");
    exit;
}
// End Of Cek Status Login

$id = $_SESSION["login"];
$result = $db->db_From_Id("SELECT * FROM user WHERE id = '$id' LIMIT 1");
$data_username = "";
$no_table = 0;
foreach ($result as $query_order) {
    $data_username = $query_order["username"];
}
// $result_table = $db->db_From_Id("SELECT * FROM user_order WHERE order_id = '$data_username'");
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']);
}
if (isset($_SESSION['status'])) {
    $status = $_SESSION['status'];
    unset($_SESSION['status']);
}

?>
<!DOCTYPE html>

<html lang="en">

<head>
  <link rel="stylesheet" href="css/order.css">
  <title>Order</title>
  <base href="./">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
  <meta name="author" content="Łukasz Holeczek">
  <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
  <link rel="apple-touch-icon" sizes="57x57" href="assets/favicon/apple-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="60x60" href="assets/favicon/apple-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="72x72" href="assets/favicon/apple-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="76x76" href="assets/favicon/apple-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="114x114" href="assets/favicon/apple-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="120x120" href="assets/favicon/apple-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="144x144" href="assets/favicon/apple-icon-144x144.png">
  <link rel="apple-touch-icon" sizes="152x152" href="assets/favicon/apple-icon-152x152.png">
  <link rel="apple-touch-icon" sizes="180x180" href="assets/favicon/apple-icon-180x180.png">
  <link rel="icon" type="image/png" sizes="192x192" href="assets/favicon/android-icon-192x192.png">
  <link rel="icon" type="image/png" sizes="32x32" href="assets/favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="96x96" href="assets/favicon/favicon-96x96.png">
  <link rel="icon" type="image/png" sizes="16x16" href="assets/favicon/favicon-16x16.png">
  <link rel="manifest" href="assets/favicon/manifest.json">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="assets/favicon/ms-icon-144x144.png">
  <meta name="theme-color" content="#ffffff">
  <!-- Vendors styles-->
  <link rel="stylesheet" href="vendors/simplebar/css/simplebar.css">
  <link rel="stylesheet" href="css/vendors/simplebar.css">
  <!-- Main styles for this application-->
  <link href="css/style.css" rel="stylesheet">
  <!-- We use those styles to show code examples, you should remove them in your application.-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/prismjs@1.23.0/themes/prism.css">
  <link href="css/examples.css" rel="stylesheet">
  <!-- Global site tag (gtag.js) - Google Analytics-->
  <script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-118965717-3"></script>
  <!-- Styles -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
  <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
  <!-- Or for RTL support -->
  <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />

  <!-- Scripts -->
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());
    // Shared ID
    gtag('config', 'UA-118965717-3');
    // Bootstrap ID
    gtag('config', 'UA-118965717-5');
  </script>
  <link href="vendors/@coreui/chartjs/css/coreui-chartjs.css" rel="stylesheet">
</head>

<body>
  <?php include "sidebar.html";?>
  <div class="wrapper d-flex flex-column min-vh-100 bg-light">
    <header class="header header-sticky mb-4">
      <div class="container-fluid">
        <button class="header-toggler px-md-0 me-md-3" type="button"
          onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
          <svg class="icon icon-lg">
            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-menu"></use>
          </svg>
        </button>


        <ul class="header-nav ms-3">
          <?php foreach ($result as $username): ?>
          <p><strong><?php echo $username["username"] ?></strong></p>
          <?php endforeach?>

        </ul>
      </div>

    </header>
    <div class="body flex-grow-1 px-3">
      <div class="container-lg">

        <!-- /.row-->

        <div class="form-style-10">
          <h1>Buat Pesanan<span>Mohon isi informasi anda dengan lengkap</span></h1>
          <label for="">Anda Dapat Memilih untuk Hanya Memesan Tiket atau Menyewa Kendaraan </label>
          <div class="inner-wrap">
            <a href="" class="btn btn-primary disabled">Pesan Tiket</a>
            <a href="sewa.php" class="btn btn-primary">Sewa Angkutan Wisata</a>
          </div>
          <form action="" method="post" enctype="multipart/form-data" id="formOrder">
            <!-- BAGIAN 1 -->
            <div class="section"><span>1</span>Informasi Pemesan</div>
            <div class="inner-wrap">
              <?php foreach ($result as $data_form): ?>
              <!-- GENERATE ORDER ID MENGGUNAKAN USERNAME + ID ACAK -->
              <input type="hidden" name="kode_order" value="<?php echo $id_tiket_acak ?>" readonly /></label>
              <input type="hidden" name="user_id" value="<?php echo $result[0]['id'] ?>" readonly /></label>

              <!-- GENERATE USERNAME MENGGUNAKAN USERNAME TERDAFTAR DI DATABASE -->
              <label>Username <input type="text" name="username" value="<?php echo $data_form["username"] ?>"
                  readonly /></label>

              <!-- GENERATE WA / EMAIL SESUAI YANG TERDAFTAR DI DATABASE -->
              <label>Whatsapp / Email <input type="text" name="email"
                  value="<?php echo $data_form["no_wa"] ?> / <?php echo $data_form["email"] ?>" readonly /></label>
              <?php endforeach?>
            </div>
            <!-- END OF BAGIAN 1 -->

            <!-- BAGIAN 2 -->
            <div class="section"><span>2</span>Informasi Pemesanan</div>

            <div class="inner-wrap">

              <label>Tanggal Pesan <input type="text" class="tanggal-datepicker" required name="tanggal_order"
                  id="tglOrder"></label>
              <input type="hidden" required name="order_type" value="tiket">
              <div class="titik-berangkat-wrapper d-none">
                <label for="">Titik Keberangkatan<select name="berangkat" id="titikBerangkat">
                    <option value="">Pilih Titik Keberangkatan</option>
                    <?php foreach ($lokasi as $l): ?>
                    <option value="<?=$l['id'];?>"><?=$l['lokasi'];?></option>
                    <?php endforeach;?>
                  </select></label>
              </div>

              <div class="berangkat-wrapper d-none">
                <label for="">Jadwal Berangkat<select name="jadwal_berangkat" id="jadwalBerangkat">
                    <option value="">Pilih Jadwal Keberangkatan</option>
                  </select></label>
              </div>
              <div class="berangkat-wrapper d-none">
                <label for="">Tujuan<select name="tujuan" id="tujuanBerangkat" aria-placeholder="Pilih Tujuan">
                    <option value="">Pilih Tujuan</option>
                    <?php foreach ($lokasi as $l): ?>
                    <option value="<?=$l['id'];?>"><?=$l['lokasi'];?></option>
                    <?php endforeach;?>
                  </select></label>
              </div>

              <div class="kursi-wrapper d-none">
                <label for="">Kursi Penumpang<select name="kursi" id="kursiPenumpang">
                    <option value="">Pilih Kursi</option>
                  </select></label>
                <button id="btn-seat-image" class="btn btn-primary mb-3">Lihat Denah Kursi</button>
              </div>

            </div>
            <!-- END OF BAGIAN 2 -->

            <!-- BAGIAN 3 -->
            <div class="section"><span>3</span>Informasi Pembayaran</div>

            <div class="inner-wrap">
              <p>Silahkan Transfer uang sejumlah jumlah yang tertera</p>
              <label for="">Metode Pembayaran<select name="metode_pembayaran" id="metodePembayaran" aria-placeholder="Pilih Tujuan" required>
                    <option value="">Pilih Metode Pembayaran</option>'
                    <option value="BNI">BNI</option>
                    <option value="BSI">BSI</option>
                    <option value="Seabank">Seabank</option>
                    <option value="Shopeepay">Shopeepay</option>
                    <option value="Gopay">Gopay</option>
                    <option value="QRIS">QRIS</option>
                  </select></label>
              <!-- END OF JENIS PESANAN -->
              <div class="penerima-wrapper">
                <label for=""><input type="text" name="penerima" readonly></label>
              </div>
              <!-- END OF NILAI SESUAI PESANAN YANG DIPILIH -->

              <!-- UPLOAD BUKTI TRANSFER -->
              <label for="total_pembayaran">Total Pembayaran<input type="number" name="total_pembayaran" value="50000"
                  readonly></label>
              <label>Bukti Transfer <input type="file" name="gambar" required
                  accept="image/png, image/gif, image/jpeg"></label>
            </div>
            <!-- END OF BAGIAN 3 -->

            <!-- TOMBOL KIRIM -->
            <div class="button-section">
              <input type="submit" name="pesan" value="Kirim" />
            </div>
          </form>

        </div>
        <!-- /.row-->
      </div>
    </div>

  </div>
  <!-- CoreUI and necessary plugins-->
  <script src="vendors/@coreui/coreui/js/coreui.bundle.min.js"></script>
  <script src="vendors/simplebar/js/simplebar.min.js"></script>
  <!-- Plugins and scripts required by this view-->
  <script src="vendors/chart.js/js/chart.min.js"></script>
  <script src="vendors/@coreui/chartjs/js/coreui-chartjs.js"></script>
  <script src="vendors/@coreui/utils/js/coreui-utils.js"></script>
  <script src="js/main.js"></script>
  <!-- <script src="../js/flatpicker.js"></script> -->

  <script>
    const kursi = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16']
    $(document).ready(function () {
      // VALIDATION
      $('select[name=jadwal_berangkat]').on({
        invalid: (e) => setValid(e, "Jadwal Tidak Boleh Kosong!"),
        input: (e) => e.target.setCustomValidity("")
      })
      $('#metodePembayaran').on({
        invalid: (e) => setValid(e, "Metode Pembayaran Tidak Boleh Kosong!"),
        input: (e) => e.target.setCustomValidity("")
      })

      $('select[name=kursi]').on({
        invalid: (e) => setValid(e, "Kursi Tidak Boleh Kosong!"),
        input: (e) => e.target.setCustomValidity("")
      })
      $('select[name=berangkat]').on({
        invalid: (e) => setValid(e, "Titik Berangkat Tidak Boleh Kosong!"),
        input: (e) => e.target.setCustomValidity("")
      })
      $('select[name=tujuan]').on({
        invalid: (e) => setValid(e, "Tujuan Tidak Boleh Kosong!"),
        input: (e) => e.target.setCustomValidity("")
      })
      $('input[name=gambar]').on({
        invalid: (e) => setValid(e, "Bukti Transfer Tidak Boleh Kosong!"),
        input: (e) => e.target.setCustomValidity("")
      })
      // END OF VALIDATION

      $('select[name=metode_pembayaran]').on('change', function() {
        var metode_bayar = $(this).val()
        if(metode_bayar == 'QRIS') {
          return;
        }
        var penerima = $('input[name=penerima]')
        switch (metode_bayar) {
          case 'BNI':
            penerima.val('1279702493 BNI a.n Mutiara Annisa Seftiani')
            break;
          case 'BSI':
            penerima.val('9698710800 BSI a.n. mutiara annisa seftiani')
            break;
          case 'Seabank':
            penerima.val('901501669636 Seabank a.n Mutiara Annisa Seftiani')
            break;
          case 'Shopeepay':
            penerima.val('901501669636 Seabank a.n Mutiara Annisa Seftiani')
            break;
          case 'Seabank':
            penerima.val('081903779439 Shopeepay a.n mutiaraaans')
            break;
          case 'Gopay':
            penerima.val('087786522719 gopay')
            break;
          default:
            penerima.val('')
            break;
        }
      })

      $('#btn-seat-image').on('click', function () {
        Swal.fire({
          title: "Sweet!",
          text: "Modal with a custom image.",
          imageUrl: "../../img/4_old.png",
          imageWidth: 400,
          imageHeight: 200,
          imageAlt: "Custom image"
        });
      })

      $('select[name=jadwal_berangkat]').on('change', function (e) {
        jadwal = $(this).val()
        if (jadwal == "") {
          $('.kursi-wrapper').removeClass('d-block').addClass('d-none')
          $('#kursiPenumpang').removeProp('required')
          e.preventDefault()
          return;
        }
        $.ajax({
          url: 'cekkursi.php',
          method: 'POST',
          data: {
            tanggal_order: $('input[name=tanggal_order]').val(),
            jadwal_berangkat: $('select[name=jadwal_berangkat]').val(),
            kursi: kursi
          },
          success: (res) => {
            var kursi_available = kursi
            console.log(res)
            kursi_available = kursi_available.filter(val => !res.includes(val))
            if (kursi_available.length == 0) {
              showAlert('Kursi Tidak Tersedia!', 'error', 'Silahkan Pilih Jadwal Lain')
              $('.kursi-wrapper').removeClass('d-block').addClass('d-none')
              $('#kursiPenumpang').removeProp('required')
              return;
            }
            $('select[name=kursi').find('option:not(:first)').remove().end()
            kursi_available.forEach((element) => {
              console.log(element)
              $('select[name=kursi').append(`
              <option value="${element}">${element}</option>
              `)
            })
            $('.kursi-wrapper').removeClass('d-none').addClass('d-block')
            $('#kursiPenumpang').prop('required', true)
          }
        })
      })

      $('select[name=berangkat]').on('change', function (e) {
        lokasi_id = $(this).val()
        if (lokasi_id == "") {
          $('.berangkat-wrapper').removeClass('d-block').addClass('d-none')
          $('#jadwalBerangkat').removeProp('required')
          $('#tujuanBerangkat').removeProp('required')
          e.preventDefault()
          return;
        }
        $.ajax({
          url: 'cekjadwal.php',
          method: 'POST',
          data: {
            lokasi_id: lokasi_id
          },
          success: function (res) {
            if (res.length == 0) {
              showAlert('Jadwal Tidak Ditemukan!', 'error', 'Tidak Ada Jadwal Yang Tersedia')
              $('.berangkat-wrapper').removeClass('d-block').addClass('d-none')
              $('#jadwalBerangkat').removeProp('required')
              $('#tujuanBerangkat').removeProp('required')
              return;
            }
            $('select[name=jadwal_berangkat').find('option:not(:first)').remove().end()
            res.forEach(element => {
              $('select[name=jadwal_berangkat').append(`
              <option value="${element['id']}">${element['jam']} | sesi ${element['sesi']}</option>
              `)
            });
            $('.berangkat-wrapper').removeClass('d-none').addClass('d-block')
            $('#jadwalBerangkat').prop('required', true)
            $('#tujuanBerangkat').prop('required', true)
          }
        })
      })


      $(".tanggal-datepicker").flatpickr({
        disable: [
          function (date) {
            // return true to disable
            return !(date.getDay() === 0 || date.getDay() === 6);
          },
        ],
        locale: {
          firstDayOfWeek: 1, // start week on Monday
        },
        onChange: function (selectedDates, dateStr, instance) {
          if (dateStr == "") {
            $('.titik-berangkat-wrapper').removeClass('d-block').addClass('d-none')
            $('#titikBerangkat').removeProp('required')
            e.preventDefault()
            return;
          }
          $('.titik-berangkat-wrapper').removeClass('d-none').addClass('d-block')
          $('#titikBerangkat').prop('required', true)
        }
      });

      $('#formOrder').on('submit', function (e) {
        const tgl = $('#tglOrder').val();
        console.log(tgl)
        if (tgl === "") {
          showAlert("Form Harus Diisi", "error", "Harus Mengisi Tanggal Pesan")
          e.preventDefault()
        }
      }); <?php if (isset($status) && isset($message)): ?>
        showAlert('<?=ucfirst($status);?>', '<?=$status;?>', '<?=$message;?>') <?php endif;?>
    });

    function showAlert(title, icon, message) {
      Swal.fire({
        title: title,
        text: message,
        icon: icon,
      })
    }

    function setValid(e, message) {
      e.target.setCustomValidity("");
      if (!e.target.validity.valid) {
        e.target.setCustomValidity(message);
      }
    }
  </script>
</body>

</html>
