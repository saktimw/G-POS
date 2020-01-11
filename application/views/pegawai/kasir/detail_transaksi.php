
<div class="box box-success">
    <div class="box-body">
        <h4>Detail Pembelian - <?=$id?></h4>
        <a href="<?=base_url('kasir/transaksi')?>" class="btn btn-sm btn-success">
            <span class="fa fa-arrow-left"></span>
            <span> Kembali</span>
        </a>
        <br><br>
        <table class="table table-striped table-bordered" id="detailTransaksi">
            <thead>
                <tr>
                    <th>No </th>
                    <th>Nama Barang </th>
                    <th>Harga</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
        <?php
            if ($detail->num_rows() > 0)
            {
                $no = 1;
                foreach ($detail->result() as $d) {
        ?>
                <tr>
                    <td><?=$no?></td>
                    <td><?=$d->nama_b?></td>
                    <td><?=number_format($d->harga_jual)?></td>
                    <td><?=$d->qty?></td>
                    <td><?=number_format($d->subtotal)?></td>
                    <td align="center">
                        <a href="<?=base_url('kasir/del_detail/'.$d->id_detailbeli)?>" class="btn btn-sm btn-danger" onClick="return confirm('Hapus Data Ini ?')">
                            <span class="fa fa-trash"></span>
                            <span> Hapus</span>
                        </a>
                    </td>
                </tr>
        <?php
                $no++;
                }
            }
        ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    $('#detailTransaksi').DataTable();
</script>