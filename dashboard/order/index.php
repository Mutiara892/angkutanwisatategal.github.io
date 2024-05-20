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
$data_username = "";
$no_table = 0;
foreach ($result as $query_order) {
    $data_username = $query_order["username"];
}
$result_table = $db->db_From_Id("SELECT * FROM user_order WHERE user_id = '{$result[0]['id']}'");

foreach ($result_table as $key => $value) {
    $lokasi = $db->db_From_Id("SELECT * FROM order_lokasi JOIN lokasi ON lokasi.id = lokasi_id WHERE user_order_id = {$value['id']}");
    $result_table[$key]['lokasi'] = $lokasi;
}

?>
<!DOCTYPE html>

<html lang="en">

<head>
  <base href="./">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
  <meta name="author" content="Łukasz Holeczek">
  <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
  <title>Order</title>
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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <!-- Custom styles for this template -->

  <!-- Global site tag (gtag.js) - Google Analytics-->
  <script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-118965717-3"></script>
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
  <?php
include "sidebar.html";
?>
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
        <div class="row">
          <div class="col-md-12">
            <div class="card mb-4">
              <div class="card-header">Pembelian</div>
              <div class="card-body">

                <!-- /.row-->
                <div class="table-responsive">
                  <table class="table border mb-0">
                    <thead class="table-light fw-semibold">
                      <tr class="align-middle">
                        <th class="text-center">
                          No
                        </th>
                        <th>Kode Order</th>
                        <th class="">Tanggal Pesanan</th>
                        <th>Status</th>
                        <th>Cetak Tiket</th>
                        <th>Detail</th>
                      </tr>
                    </thead>
                    <tbody>

                      <?php foreach ($result_table as $table): ?>
                      <?php $no_table++?>
                      <tr class="align-middle">
                        <td class="text-center">
                          <div class=""><span><?php echo $no_table ?></span></div>
                        </td>
                        <td>
                          <div><?php echo $table["kode_order"] ?></div>

                        </td>
                        <td>
                          <div class="">
                            <b><?php echo date_format(date_create($table["tanggal_order"]), 'd F Y') ?>
                              <?php echo ($table["tanggal_selesai_order"]) ? " - " . date_format(date_create($table["tanggal_selesai_order"]), 'd F Y') : "" ?>
                            </b></div>
                        </td>
                        <?php if ($table['tolak'] == 0): ?>
                        <?php if ($table['konfirmasi'] == 0): ?>
                        <td><span class="badge bg-warning">Menunggu Konfirmasi</span></td>
                        <td><a href="#" class="btn btn-primary disabled">Cetak Tiket</a></td>
                        <?php else: ?>
                        <td><span class="badge bg-success">Terkonfirmasi</span></td>
                        <td><a href="cetaktiket.php?kode_order=<?=$table['kode_order'];?>" class="btn btn-primary">Cetak
                            Tiket</a></td>
                        <?php endif;?>
                        <?php elseif ($table['tolak'] == 1): ?>
                        <td><span class="badge bg-danger">Ditolak</span></td>
                        <td><a href="#" class="btn btn-primary disabled">Cetak Tiket</a></td>
                        <?php endif;?>
                        <td class="">
                          <button type="button" class="btn btn-warning" data-toggle="modal"
                            data-target=<?="#modal{$table['id']}";?>>Lihat</button>
                          <!-- Modal -->
                          <div class="modal fade" id=<?="modal{$table['id']}";?> tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Detail Pesanan</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body text-center">
                                  <div class="form-group">
                                    <label for="exampleInputPassword1">Waktu
                                      Pesanan</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1"
                                      value="<?php echo $table["created_at"] ?>">
                                  </div>
                                  <div class="form-group">
                                    <label for="exampleInputPassword1">Metode Pembayaran</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1"
                                      value="<?php echo $table["metode_pembayaran"] ?? "" ?>">
                                  </div>
                                  <div class="form-group">
                                    <label for="">Bukti Pembayaran</label>
                                    <br>
                                    <img src="../db_images/<?php echo $table["bukti_pembayaran"] ?>" class="img-fluid">
                                  </div>
                                  <?php if ($table['order_type'] == 'sewa'): ?>
                                  <div class="form-group">
                                    <label for="exampleInputPassword1">Titik Berangkat</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1"
                                      value="<?php echo $table["lokasi"][0]['lokasi'] ?>">
                                  </div>
                                  <table class="table table-bordered">
                                    <thead>
                                      <th>Tujuan</th>
                                    </thead>
                                    <tbody>
                                      <?php foreach ($table['lokasi'] as $key => $value):
                                        if($key == 0) continue;?>
                                      <tr>
                                        <td><?=$value['lokasi'];?></td>
                                      </tr>
                                      <?php endforeach;?>
                                    </tbody>
                                  </table>
                                  <?php else: ?>
                                  <table class="table table-bordered">
                                    <tbody>
                                      <tr>
                                        <th>Berangkat</th>
                                        <td><?=$table['lokasi'][0]['lokasi'];?></td>
                                      </tr>
                                      <tr>
                                        <th>Tujuan</th>
                                        <td><?=$table['lokasi'][1]['lokasi'];?></td>
                                      </tr>
                                    </tbody>
                                  </table>
                                  <?php endif;?>
                                </div>
                              </div>
                            </div>
                        </td>
                        <!-- Button trigger modal -->
                      </tr>
                      <?php endforeach?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <!-- /.col-->
        </div>
        <!-- /.row-->
      </div>
    </div>

  </div>
  <!-- Bootstrap core JavaScript-->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
  </script>

  <!-- CoreUI and necessary plugins-->
  <script src="vendors/@coreui/coreui/js/coreui.bundle.min.js"></script>
  <script src="vendors/simplebar/js/simplebar.min.js"></script>
  <!-- Plugins and scripts required by this view-->
  <script src="vendors/chart.js/js/chart.min.js"></script>
  <script src="vendors/@coreui/chartjs/js/coreui-chartjs.js"></script>
  <script src="vendors/@coreui/utils/js/coreui-utils.js"></script>
  <script src="js/main.js"></script>
  <script>
  </script>

</body>

</html>
