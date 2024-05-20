<?php
include '../proses.php';
$db = new Connect_db();
$lokasi_id = $_POST['lokasi_id'];
$result = $db->db_From_Id("SELECT * FROM jadwal WHERE lokasi_id = $lokasi_id AND jenis_jadwal = 'berangkat'");
header('Content-type: application/json');
echo json_encode($result);
?>
