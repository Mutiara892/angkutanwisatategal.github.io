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
    $tanggal_order_arr = explode(' to ', $_POST["tanggal_order"]);
    $tanggal_order = $tanggal_order_arr[0];
    $tanggal_selesai_order = $tanggal_order_arr[1] ?? $tanggal_order_arr[0];
    // var_dump($_POST['tanggal_order'],$tanggal_order_arr, $tanggal_selesai_order);
    // exit;
    $titik_berangkat = $_POST["titik_berangkat"];
    $order_type = $_POST["order_type"];
    $tujuan = $_POST["tujuan"];
    $metode_pembayaran = $_POST["metode_pembayaran"];
    $total_pembayaran = $_POST["total_pembayaran"];
    $bukti_transfer = $db->upload_Gambar($_FILES["gambar"]);
    $db->set_Pesanan_sewa($user_id, $kode_order, $order_type, $tanggal_order, $tanggal_selesai_order, $total_pembayaran, $bukti_transfer, $titik_berangkat, $tujuan, $metode_pembayaran);
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
  <!-- Styles -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
  <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
  <!-- Or for RTL support -->
  <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <!-- Global site tag (gtag.js) - Google Analytics-->
  <script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-118965717-3"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
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
            <a href="order.php" class="btn btn-primary">Pesan Tiket</a>
            <a href="sewa.php" class="btn btn-primary disabled">Sewa Angkutan Wisata</a>
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
              <label for="">Tanggal Sewa<input type="text" required name="tanggal_order"></label>
              <label for="">Titik Berangkat <select name="titik_berangkat" id="">
                <option value="">Pilih Titik Berangkat</option>
                <?php foreach($lokasi as $l): ?>
                  <option value="<?=$l['id'];?>"><?=$l['lokasi'];?></option>
                <?php endforeach; ?>
              </select></label>
              <input type="hidden" required name="order_type" value="sewa">
              <label for="">Tujuan Perjalanan<select name="tujuan[]" class="form-select" id="tujuan-select" multiple
                  data-placeholder="Pilih Tujuan" required>
                  <?php foreach ($lokasi as $l): ?>
                  <option value="<?=$l['id'];?>"><?=$l['lokasi'];?></option>
                  <?php endforeach;?>
                </select></label>

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

              <!-- UPLOAD BUKTI TRANSFER -->
              <label for="total_pembayaran">Total Pembayaran<input type="number" name="total_pembayaran" value=""
                  readonly></label>
              <label>Bukti Transfer <input type="file" name="gambar" accept="image/png, image/gif, image/jpeg" required></label>
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
    $(document).ready(function () {
      $('select[name=metode_pembayaran]').on({
        invalid: (e) => setValid(e, "Metode Pembayaran Tidak Boleh Kosong!"),
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

      $('#formOrder').on('submit', function (e) {
        const tgl_order = $('input[name=tanggal_order]').val();
        const titik_berangkat = $('input[name=titik_berangkat]').val();
        if(tgl_order == "") {
          showAlert("Form Tidak Boleh Kosong", "error", "Tanggal Sewa Tidak Boleh Kosong");
          e.preventDefault()
        }
        if(titik_berangkat == "") {
          showAlert("Form Tidak Boleh Kosong", "error", "Titik Berangkat Tidak Boleh Kosong");
          e.preventDefault();
        }
      });
      $('#tujuan-select').select2({
        theme: "bootstrap-5",
        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
        placeholder: $(this).data('placeholder'),
        closeOnSelect: false,
      });

      $("input[name=tanggal_order]").flatpickr({
        mode: 'range',
        minDate: 'today',
        onChange: function (selectedDates, dateStr, instance) {
          if (selectedDates.length > 1) {
            var range = instance.formatDate(selectedDates[1], 'U') - instance.formatDate(selectedDates[0],
              'U');
            range = range / 86400;

            if (range > 2) {
              showAlert('Batas Maksimal Penyewaan', 'error', 'Penyewaan Maksimal 3 Hari')
              instance.clear()
            } else {
              $('input[name=total_pembayaran]').val((range+1)*50000)
            }

          }

        },
        locale: {
          firstDayOfWeek: 1, // start week on Monday
        },
      });

      <?php if (isset($status) && isset($message)): ?>
        showAlert('<?=ucfirst($status);?>', '<?=$status;?>', '<?=$message;?>')
        <?php endif;?>
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
