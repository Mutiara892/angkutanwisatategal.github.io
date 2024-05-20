<?php
$id = $_GET["id"];
include("../proses.php");
$db = new Connect_db();
$result = $db->db_From_Id("SELECT * FROM user_order WHERE id = '$id'");
if (!isset($_SESSION["login_admin"])) {
    header("Location: loginadmin.php");
    exit;
}

try {
    //code...
    $conn = mysqli_connect($db->servername, $db->username, "", $db->db_name);
    mysqli_query(
        $conn,
        "UPDATE user_order SET tolak = 1 WHERE id = '$id'"
    );
    $_SESSION['status'] = "success";
    $_SESSION['message'] = "Berhasil Menolak Pesanan";
} catch (\Throwable $th) {
    $_SESSION['status'] = "error";
    $_SESSION['message'] = "Gagal Melakukan Update";
}

header("Location: konfirmasi.php");
