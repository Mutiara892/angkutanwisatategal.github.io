<!-- AKAN DILAKUKAN JIKA ADMIN SUDAH KONFIRMASI PESANAN -->
<?php
$id = $_GET["kode_order"];
include "../proses.php";
$db = new Connect_db();
$order = $db->db_From_Id("SELECT * FROM user_order WHERE kode_order = '$id' LIMIT 1");
$jam = $db->db_From_Id("SELECT * FROM order_jadwal as oj JOIN jadwal ON oj.jadwal_id = jadwal.id WHERE oj.user_order_id = '$id' LIMIT 1");
foreach ($order as $key => $value) {
    $lokasi = $db->db_From_Id("SELECT * FROM order_lokasi JOIN lokasi ON lokasi.id = lokasi_id WHERE user_order_id = {$value['id']}");
    $order[$key]['lokasi'] = $lokasi;
}
$order = $order[0];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/cetaktiket.css">
  <title>Cetak Tiket</title>
</head>

<body>
  <link href="https://fonts.googleapis.com/css?family=Cabin|Indie+Flower|Inknut+Antiqua|Lora|Ravi+Prakash"
    rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" /> -->


  <div class="container">
    <h1 class="upcomming">Cetak Tiket Anda Segera</h1>
    <div class="item">
      <div class="item-right">
        <h2 class="num"><?=date_format(date_create($order['tanggal_order']), 'd');?></h2>
        <p class="day"><?=date_format(date_create($order['tanggal_order']), 'F');?></p>
        <p class=""><?= $order['order_type'] == 'tiket' ? 'Nomor Kursi: ' . $order['kursi'] : ''; ?></p>
        <span class="up-border"></span>
        <span class="down-border"></span>
      </div> <!-- end item-right -->

      <div class="item-left">
        <p class="event">Kode Tiket : <?php echo $order['kode_order'] ?></p>

        <h2 class="title">Tiket Angkutan Wisata Tegal</h2>

        <div class="sce">
          <div class="icon">
            <i class="fa fa-table"></i>
          </div>
          <p><?=$order['tanggal_order'];?>
            <?php echo ($order["tanggal_selesai_order"]) ? " - " . ($order["tanggal_selesai_order"]) : "" ?> <span
              class=""><?= $jam['jam'] ?? "" ?></span></p>
        </div>
        <div class="fix"></div>
        <div class="loc">
          <div class="icon">
            <i class="fa fa-map-marker"></i>
          </div>
          <p>Asal: <?=$order['lokasi'][0]['lokasi']?> </p>
        </div>
        <div class="fix"></div>
        <div class="loc">
          <div class="icon">
            <i class="fa fa-map-marker"></i>
          </div>
          <p>Tujuan:
            <?php
              $string = '';
              foreach ($order['lokasi'] as $key => $value) {
                  if ($key == 0) {
                      continue;
                  }
                  $string .= $value['lokasi'] . ', ';
              }
              echo substr($string, 0, -2);
            ?>
          </p>
        </div>
        <div class="fix"></div>
        <div class="loc">
          <div class="icon">
            <i class="fa fa-usd"></i>
          </div>
          <p>Harga: Rp. <?=$order['total_pembayaran']?> </p>
        </div>
        <div class="fix"></div>
        <p>Harap tiket disimpan dan ditunjukkan ke petugas saat memasuki angkutan</p>

      </div> <!-- end item-right -->
    </div> <!-- end item -->

    <script>
      window.print();
    </script>
  </div>
</body>

</html>
