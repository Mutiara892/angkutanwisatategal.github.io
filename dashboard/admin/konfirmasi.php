<?php
include "../proses.php";
$db = new Connect_db();
if (!isset($_SESSION["login_admin"])) {
    header("Location: loginadmin.php");
    exit;
}
$id_nama = $_SESSION["login_admin"];
$result_data = $db->db_From_Id("SELECT * FROM admin WHERE id = '$id_nama'");
$result_table = $db->db_From_Id("SELECT * FROM user_order WHERE konfirmasi = 0 AND tolak = 0");
foreach ($result_table as $key => $value) {
    $user = $db->db_From_Id("SELECT * FROM user WHERE id = {$value['user_id']} LIMIT 1");
    $result_table[$key]['user'] = $user[0];
    $lokasi = $db->db_From_Id("SELECT * FROM order_lokasi JOIN lokasi ON lokasi.id = lokasi_id WHERE user_order_id = {$value['id']}");
    $result_table[$key]['lokasi'] = $lokasi;

}
$no = 0;

if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']);
}
if (isset($_SESSION['status'])) {
    $status = $_SESSION['status'];
    unset($_SESSION['status']);
}
$page = 'pesanan_konfirmasi';
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php
        include "sidebar.html";
        ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php
                include "topbar.html";
                ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Konfirmasi Pesanan</h1>
                    <p class="mb-4">Harap konfirmasi pesanan yang sudah masuk, jika semua informasi yang diberikan sudah
                        benar, silahkan klik verify pada kolom yang sesuai</p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Pesanan Tertunda</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Order</th>
                                            <th>Username</th>
                                            <th>Tipe</th>
                                            <th>Total Pembayaran</th>
                                            <th>Tanggal Pesanan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($result_table as $key => $data): ?>
                                        <?php $no++?>
                                        <?php include 'order_row_template.php' ?>
                                        <?php endforeach;?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>



    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>
    <script>
        $(document).ready(function () {
            <?php if (isset($status) && isset($message)): ?>
                showAlert('<?=ucfirst($status);?>', '<?=$status;?>', '<?=$message;?>')
            <?php endif; ?>
        });

        function showAlert(title, icon, message) {
            Swal.fire({
                title: title,
                text: message,
                icon: icon,
            })
        }
    </script>

</body>

</html>
