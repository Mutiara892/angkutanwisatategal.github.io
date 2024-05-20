<?php
include "../proses.php";
$db = new Connect_db();
if (!isset($_SESSION["login_admin"])) {
    header("Location: loginadmin.php");
    exit;
}
$id_nama = $_SESSION["login_admin"];
$result_data = $db->db_From_Id("SELECT * FROM admin WHERE id = '$id_nama'");
// $result_table = $db->db_From_Id("SELECT * FROM user_order WHERE status = 'pending'");
$no = 0;
$jadwal = [];

$lokasi = $db->db_From_Id("SELECT * FROM lokasi");

$max_berangkat = 0;
$max_kembali = 0;

foreach ($lokasi as $key => $value) {
    $jadwal_berangkat = $db->db_From_Id("SELECT * FROM jadwal WHERE jadwal.lokasi_id = {$value['id']} AND jenis_jadwal = 'berangkat' ORDER BY sesi ASC");
    $max_berangkat = count($jadwal_berangkat) > $max_berangkat ? count($jadwal_berangkat) : $max_berangkat;
    $jadwal_kembali = $db->db_From_Id("SELECT * FROM jadwal WHERE jadwal.lokasi_id = {$value['id']} AND jenis_jadwal = 'kembali' ORDER BY sesi ASC");
    $max_kembali = count($jadwal_kembali) > $max_kembali ? count($jadwal_kembali) : $max_kembali;
    $value['jadwal_berangkat'] = $jadwal_berangkat;
    $value['jadwal_kembali'] = $jadwal_kembali;
    $lokasi[$key] = $value;
}

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
    <link href="css/admin.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

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
                <?php include "topbar.html";?>
                <!-- End of Topbar -->
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Halaman Jadwal</h1>
                    <p class="mb-4">Untuk Mengelola Jadwal</p>
                    <?php if (isset($_SESSION['success']) || isset($_SESSION['errors'])):
    $message_type = isset($_SESSION['success']) ? 'success' : 'errors';
    $message = isset($_SESSION['success']) ? $_SESSION['success'] : $_SESSION['errors']
    ?>
                    <div class="alert <?=$message_type == 'success' ? 'alert-success' : 'alert-danger';?> alert-dismissible fade show"
                        role="alert">
                        <?=$message;?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php if ($message_type == 'success') {
        unset($_SESSION['success']);
    } else {unset($_SESSION['errors']);}
endif;
?>
                    <!-- card filter lokasi -->

                    <div class="card shadow">
                        <div class="card-header">Jadwal</div>
                        <div class="card-body">
                            <button type="button" class="btn btn-success mb-3" data-toggle="modal"
                                data-target="#modalTambahJadwal"><i class="fas fa-calendar-plus"></i> Tambah
                                Jadwal</button>
                            <div class="table-responsive-xl">
                                <table class="table table-bordered">
                                    <tr>
                                        <thead>
                                            <th style="width: 200px;">Lokasi</th>
                                            <th colspan="<?=$max_berangkat;?>">Jam Keberangkatan</th>
                                            <th colspan="<?=$max_kembali;?>">Jam Kembali</th>
                                        </thead>
                                        <tbody>
                                            <?php if (count($lokasi) == 0): ?>
                                            <td colspan="4" class="text-center">Tidak Ada Data yang Ditampilkan</td>
                                            <?php else: ?>
                                            <?php foreach ($lokasi as $key => $l): ?>
                                            <tr>
                                                <td><?=$l['lokasi'];?></td>
                                                <?php foreach ($l['jadwal_berangkat'] as $key => $j): ?>
                                                <td class="jadwal-cell"><?=$j['jam'];?>
                                                    <button type="button" class="btn btn-warning" data-toggle="modal"
                                                        data-target=<?="#modal{$l['id']}{$j['id']}";?>><i
                                                            class="fas fa-pencil-alt"></i></button>
                                                    <a href="jadwal_delete.php?jadwal_id=<?=$j['id'];?>"
                                                        class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id=<?="modal{$l['id']}{$j['id']}";?>
                                                        tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Edit
                                                                        Jadwal</h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="jadwal_update.php" method="post">
                                                                        <div class="form-group">
                                                                            <label for="exampleInputEmail1">Jam</label>
                                                                            <input type="hidden" value="<?=$j['id'];?>"
                                                                                name="jadwal_id">
                                                                            <input type="time" class="form-control"
                                                                                name="jadwal_jam"
                                                                                value="<?=$j['jam'];?>"
                                                                                aria-describedby="emailHelp">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="exampleInputEmail1">Sesi</label>
                                                                            <input type="number" class="form-control"
                                                                                name="sesi" value="<?= $j['sesi']; ?>"
                                                                                aria-describedby="emailHelp">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="exampleInputEmail1">Jenis
                                                                                Jadwal</label>
                                                                            <select name="jenis_jadwal"
                                                                                class="form-control" id="">
                                                                                <option value="<?= $j['jenis_jadwal']; ?>"><?= $j['jenis_jadwal'] == 'berangkat' ? 'Jadwal Berangkat' : 'Jadwal Kembali'; ?></option>
                                                                                <option value="berangkat">Jadwal
                                                                                    Berangkat</option>
                                                                                <option value="kembali">Jadwal Kembali
                                                                                </option>
                                                                            </select>
                                                                        </div>
                                                                        <input type="submit" class="btn btn-success"
                                                                            value="SIMPAN">
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <?php endforeach;?>
                                                <?php if (count($l['jadwal_berangkat']) < $max_berangkat): ?>
                                                <?php for ($i = 0; $i < ($max_berangkat - count($l['jadwal_berangkat'])); $i++): ?>
                                                <td></td>
                                                <?php endfor;?>
                                                <?php endif;?>

                                                <?php foreach ($l['jadwal_kembali'] as $key => $j): ?>
                                                <td class="jadwal-cell"><?=$j['jam'];?>
                                                    <button type="button" class="btn btn-warning" data-toggle="modal"
                                                        data-target=<?="#modal{$l['id']}{$j['id']}";?>><i
                                                            class="fas fa-pencil-alt"></i></button>
                                                    <a href="jadwal_delete.php?jadwal_id=<?=$j['id'];?>"
                                                        class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id=<?="modal{$l['id']}{$j['id']}";?>
                                                        tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Edit
                                                                        Jadwal</h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="jadwal_update.php" method="post">
                                                                        <div class="form-group">
                                                                            <label for="exampleInputEmail1">Jam</label>
                                                                            <input type="hidden" value="<?=$j['id'];?>"
                                                                                name="jadwal_id">
                                                                            <input type="time" class="form-control"
                                                                                name="jadwal_jam"
                                                                                value="<?=$j['jam'];?>"
                                                                                aria-describedby="emailHelp">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="exampleInputEmail1">Sesi</label>
                                                                            <input type="number" class="form-control"
                                                                                name="sesi" value="<?= $j['sesi']; ?>"
                                                                                aria-describedby="emailHelp">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="exampleInputEmail1">Jenis
                                                                                Jadwal</label>
                                                                            <select name="jenis_jadwal"
                                                                                class="form-control" id="">
                                                                                <option value="<?= $j['jenis_jadwal']; ?>"><?= $j['jenis_jadwal'] == 'berangkat' ? 'Jadwal Berangkat' : 'Jadwal Kembali'; ?></option>
                                                                                <option value="berangkat">Jadwal
                                                                                    Berangkat</option>
                                                                                <option value="kembali">Jadwal Kembali
                                                                                </option>
                                                                            </select>
                                                                        </div>
                                                                        <input type="submit" class="btn btn-success"
                                                                            value="SIMPAN">
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <?php endforeach;?>
                                                <?php if (count($l['jadwal_kembali']) < $max_kembali): ?>
                                                <?php for ($i = 0; $i < ($max_kembali - count($l['jadwal_kembali'])); $i++): ?>
                                                <td></td>
                                                <?php endfor;?>
                                                <?php endif;?>
                                            </tr>
                                            <?php endforeach;?>
                                            <?php endif;?>
                                        </tbody>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>

            <!-- End of Main Content -->

            <!-- Modal -->
            <div class="modal fade" id=<?="modalTambahJadwal";?> tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah
                                Jadwal</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="jadwal_tambah.php" method="post">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Lokasi</label>
                                    <select class="form-control" id="exampleFormControlSelect1" required
                                        name="lokasi_id">
                                        <option value="">Pilih Lokasi</option>
                                        <?php foreach ($lokasi as $l): ?>
                                        <option value="<?=$l['id'];?>"><?=$l['lokasi'];?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Jam</label>
                                    <input type="time" class="form-control" name="jadwal_jam"
                                        aria-describedby="emailHelp">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Sesi</label>
                                    <input type="number" class="form-control" name="sesi" aria-describedby="emailHelp">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Jenis Jadwal</label>
                                    <select name="jenis_jadwal" class="form-control" id="">
                                        <option value="berangkat">Jadwal Berangkat</option>
                                        <option value="kembali">Jadwal Kembali</option>
                                    </select>
                                </div>
                                <input type="submit" class="btn btn-success" value="SIMPAN">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
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

    </script>
</body>

</html>
