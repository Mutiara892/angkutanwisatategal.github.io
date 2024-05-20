<?php
include "../proses.php";
$db = new Connect_db();

// update DB

$jadwal_id = $_POST['jadwal_id'] ?? null;
$jadwal_jam = $_POST['jadwal_jam'] ?? null;
$sesi = $_POST['sesi'] ?? null;
$jenis_jadwal = $_POST['jenis_jadwal'] ?? null;
//code...
try {
    $conn = mysqli_connect($db->servername, $db->username, "", $db->db_name);
    mysqli_query(
        $conn,
        "UPDATE jadwal SET jam = '{$jadwal_jam}', sesi = $sesi, jenis_jadwal = '$jenis_jadwal' WHERE id = {$jadwal_id}"
    );
    $_SESSION['success'] = 'Berhasil Edit Jadwal';
} catch (\Throwable $th) {
    $_SESSION['errors'] = "Gagal Edit Jadwal $th";
    //throw $th;
}

header('Location: jadwal.php');
