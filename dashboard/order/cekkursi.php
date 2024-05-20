<?php
include '../proses.php';
$db = new Connect_db();
$tanggal = $_POST['tanggal_order'];
$jadwal_berangkat = $_POST['jadwal_berangkat'];
$kursi = $_POST['kursi'];
$kursi_str = "'" . implode("', '", $kursi) . "'";
$jadwal_sesi = $db->db_From_Id("SELECT * from jadwal WHERE id = '$jadwal_berangkat' LIMIT 1")[0]['sesi'];
$sql = "SELECT kursi FROM user_order as uo JOIN order_jadwal as oj ON oj.user_order_id = uo.id JOIN jadwal as j ON oj.jadwal_id = j.id WHERE uo.tanggal_order = '$tanggal' AND j.sesi = $jadwal_sesi";
$result = $db->db_From_Id($sql);
$kursi_available = [];
foreach ($result as $key => $value) {
    array_push($kursi_available, $value['kursi']);
}
header('Content-type: application/json');
echo json_encode($kursi_available);
