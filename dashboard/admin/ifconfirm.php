<?php
$id = $_GET["id"];
include "../proses.php";
$db = new Connect_db();
$order = $db->db_From_Id("SELECT * FROM user_order WHERE id = '$id' LIMIT 1");
if (!isset($_SESSION["login_admin"])) {
    header("Location: loginadmin.php");
    exit;
}
try {
    $conn = mysqli_connect($db->servername, $db->username, "", $db->db_name);
    mysqli_query(
        $conn,
        "UPDATE user_order set konfirmasi = 1 WHERE id = '{$order[0]['id']}'"
    );
    unlink("../db_images/$bukti_pembayaran");

    $_SESSION['status'] = "success";
    $_SESSION['message'] = "Berhasil Menerima Pesanan";
} catch (\Throwable $th) {
    $_SESSION['status'] = "error";
    $_SESSION['message'] = "Gagal Melakukan Update";
}
header("Location: konfirmasi.php");
