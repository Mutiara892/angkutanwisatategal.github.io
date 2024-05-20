<?php
include '../proses.php';
$db = new Connect_db();
$lokasi_id = $_POST['lokasi_id'];
$jadwal_berangkat = $_POST['jadwal_berangkat'];
$kursi = $_POST['kursi'];
$kursi_str = "'" . implode("', '", $kursi) . "'";
$jadwal = $db->db_From_Id("SELECT * from jadwal WHERE id = '$jadwal_berangkat' LIMIT 1")[0];
$jadwal_sesi = $jadwal['sesi'];
$jadwal_jenis = $jadwal['jenis_jadwal'];
$operator = $jadwal_jenis == 'berangkat' ? '>' : '<';
$sql = "SELECT * FROM lokasi WHERE id $operator '$lokasi_id'";
$result = $db->db_From_Id($sql);
header('Content-type: application/json');
echo json_encode($result);
