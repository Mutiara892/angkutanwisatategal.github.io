<?php
include "../proses.php";
$db = new Connect_db();

// update DB

$jadwal_id = $_GET['jadwal_id'] ?? null;

//code...
try {
    $conn = mysqli_connect($db->servername, $db->username, "", $db->db_name);
    mysqli_query(
        $conn,
        "DELETE FROM jadwal WHERE id = '{$jadwal_id}'"
    );
    $_SESSION['success'] = 'Berhasil Menghapus Jadwal';
} catch (\Throwable $th) {
    $_SESSION['errors'] = 'Gagal Menghapus Jadwal';
    //throw $th;
}

header('Location: jadwal.php');
