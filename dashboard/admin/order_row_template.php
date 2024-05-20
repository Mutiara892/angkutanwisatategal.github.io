<tr>
    <td><?php echo $no ?></td>
    <td><?php echo $data["kode_order"] ?></td>
    <td><?php echo $data['user']['username'] ?></td>
    <td><span
            class="badge text-white <?=$data['order_type'] == 'sewa' ? 'bg-primary' : 'bg-success';?>"><?php echo $data['order_type'] ?></span>
    </td>
    <td><?php echo $data["total_pembayaran"] ?></td>
    <td>
        <?php echo $data["tanggal_order"] ?>
        <?php echo ($data["tanggal_selesai_order"]) ? " - " . $data["tanggal_selesai_order"] : "" ?>
    </td>
    <td class="">
        <?php if($page == 'pesanan_konfirmasi') : ?>
        <a class="btn btn-success" href="ifconfirm.php?id=<?php echo $data['id'] ?>">Terima</a>
        <a class="btn btn-danger" href="ifreject.php?id=<?php echo $data['id'] ?>">Tolak</a>
        <?php endif;?>
        <button type="button" class="btn btn-warning" data-toggle="modal"
            data-target=<?="#modal{$data['id']}";?>>Lihat</button>
        <!-- Modal -->
        <div class="modal fade" id=<?="modal{$data['id']}";?> tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Pesanan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                        <div class="form-group">
                            <label for="exampleInputPassword1">WA /
                                Email</label>
                            <input type="text" class="form-control" id="exampleInputPassword1"
                                value="<?=$data['user']["no_wa"] . ' | ' . $data['user']["email"]?>">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Waktu
                                Pesanan</label>
                            <input type="text" class="form-control" id="exampleInputPassword1"
                                value="<?php echo $data["created_at"] ?>">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Waktu
                                Pesanan</label>
                            <input type="text" class="form-control" id="exampleInputPassword1"
                                value="<?php echo $data["created_at"] ?>">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Metode Pembayaran</label>
                            <input type="text" class="form-control" id="exampleInputPassword1"
                                value="<?php echo $data["metode_pembayaran"] ?>">
                        </div>
                        <div class="form-group">
                            <label for="">Bukti Pembayaran</label>
                            <br>
                            <img src="../db_images/<?php echo $data["bukti_pembayaran"] ?>" class="img-fluid">
                        </div>
                        <?php if ($data['order_type'] == 'sewa'): ?>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Titik Berangkat</label>
                            <input type="text" class="form-control" id="exampleInputPassword1"
                                value="<?php echo $data["lokasi"][0]['lokasi'] ?>">
                        </div>
                        <table class="table table-bordered">
                            <thead>
                                <th>Tujuan</th>
                            </thead>
                            <tbody>
                                <?php foreach ($data['lokasi'] as $key => $value):
                                    if($key == 0) continue;?>
                                <tr>
                                    <td><?=$value['lokasi'];?></td>
                                </tr>
                                <?php endforeach;?>
                            </tbody>
                        </table>
                        <?php else: ?>
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>Berangkat</th>
                                    <td><?=$data['lokasi'][0]['lokasi'];?></td>
                                </tr>
                                <tr>
                                    <th>Tujuan</th>
                                    <td><?=$data['lokasi'][1]['lokasi'];?></td>
                                </tr>
                            </tbody>
                        </table>
                        <?php endif;?>
                    </div>
                </div>
            </div>
    </td>
</tr>
