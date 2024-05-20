<?php
include "dashboard/proses.php";
$db = new Connect_db();
if (!isset($_SESSION["login"])) {
    header("Location: dashboard/pages/login.php");
    exit;
}

$rating = $_POST['rate'] ?? 0;
$masukan = $_POST['masukan'] ?? '';
$user_id = $_SESSION['login'] ?? '';

$user_exist = $db->db_From_Id("SELECT * FROM user_reviews WHERE user_id = '$user_id' LIMIT 1");
if(count($user_exist) > 0) {
    $_SESSION['message'] = 'Pengguna Hanya Dapat Memberikan 1 Review';
    $_SESSION['status'] = 'error';
    header('Location: index.php');
    exit;
}


try {
    $conn = mysqli_connect($db->servername, $db->username, "", $db->db_name);
    mysqli_query(
        $conn,
        "INSERT INTO user_reviews (user_id, rating, masukan_saran) VALUES ($user_id, $rating, '$masukan');"
    );
    $_SESSION['message'] = 'Review Anda Telah Kami Terima';
    $_SESSION['status'] = 'success';
} catch (\Throwable $th) {
    $_SESSION['message'] = 'Review Anda Tidak Berhasil Kami Terima';
    $_SESSION['status'] = 'error';

}

header('Location: index.php');
