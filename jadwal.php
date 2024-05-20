<?php
include "dashboard/proses.php";
$db = new Connect_db();
$page = 'jadwal';
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

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Informasi Angkutan Wisata</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>

    <?php
include 'components/navbar.php';?>
    <!--awal chowcase-->
    <section class="bg-primary text-white p-5 pt-lg-5 mt-5 text-center text-sm-start mb-4">
        <div class="card ">
            <div class="card-header">
                <h6>Jadwal Keberangkatan Angkutan (Sabtu & Minggu)</h6>
            </div>
            <div class="card-body">
                <table class="table table-bordered bg-white">
                    <tr>
                        <thead>
                            <th style="width: 200px">Lokasi</th>
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
                                <?php if (count($l['jadwal_berangkat']) == 0): ?>
                                <td colspan="<?=$max_berangkat;?>" class="text-center">Belum Ada Jadwal</td>
                                <?php else: ?>
                                <?php $col_count = $max_berangkat;?>
                                <?php foreach ($l['jadwal_berangkat'] as $key => $j): ?>
                                <?php --$col_count;?>
                                <td class="jadwal-cell"><?=$j['jam'];?> </td>
                                <?php endforeach;?>
                                <?php if ($col_count > 0): ?>
                                <td colspan="<?=$col_count;?>"></td>
                                <?php endif;?>
                                <?php endif;?>


                                <?php if (count($l['jadwal_kembali']) == 0): ?>
                                <td colspan="<?=$max_kembali;?>" class="text-center">Belum Ada Jadwal</td>
                                <?php else: ?>
                                <?php $col_count = $max_kembali?>
                                <?php foreach ($l['jadwal_kembali'] as $key => $j): ?>
                                <?php --$col_count;?>
                                <td class="jadwal-cell"><?=$j['jam'];?> </td>
                                <?php endforeach;?>
                                <?php if ($col_count > 0): ?>
                                <td colspan="<?=$col_count;?>"></td>
                                <?php endif;?>
                                <?php endif;?>
                            </tr>
                            <?php endforeach;?>
                            <?php endif;?>
                        </tbody>
                    </tr>
                </table>
            </div>
        </div>
    </section>

    <!--Akhir Materi-->
    <?php include 'components/footer.php'; ?>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>

</body>

</html>
