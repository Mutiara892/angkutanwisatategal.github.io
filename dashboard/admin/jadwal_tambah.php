<?php
include "../proses.php";
$db = new Connect_db();

// update DB

$lokasi_id = $_POST['lokasi_id'] ?? null;
$jadwal_jam = $_POST['jadwal_jam'] ?? null;
$sesi = $_POST['sesi'] ?? null;
$jenis_jadwal = $_POST['jenis_jadwal'] ?? null;

//code...
try {
    $conn = mysqli_connect($db->servername, $db->username, "", $db->db_name);
    mysqli_query(
        $conn,
        "INSERT INTO jadwal (jam, lokasi_id, sesi, jenis_jadwal) VALUES
        ('{$jadwal_jam}', '{$lokasi_id}', '$sesi', '$jenis_jadwal')"
    );
    $_SESSION['success'] = 'Berhasil Menambah Jadwal';
} catch (\Throwable $th) {
    $_SESSION['errors'] = 'Gagal Menambah Jadwal';
    //throw $th;
}

header('Location: jadwal.php');
