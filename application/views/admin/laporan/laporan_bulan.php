<h3>Laporan Bulanan</h3>
<br>
<div class="box box-success">
    <div class="box-body">
        <table class="table table-striped table-bordered" id="lapBulan">
            <thead>
                <tr>
                    <th>No </th>
                    <th>Bulan</th>
                    <th>Terjual</th>
                    <th>Total Penjualan</th>
                    <th>Laba / Rugi</th>
                    <th>Aksi </th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if ($data == null)
                    {
                        echo "<tr>";
                        echo "<td class=\"text-center\" colspan=\"6\">Data Kosong</td>";
                        echo "</tr>";
                    }
                    $no=1;
                    foreach($data as $dt){
                ?>
                <tr>
                    <td><?=$no?></td>
                    <td><?=indo_bulan($dt->bulan).' '.$dt->tahun?></td>
                    <td><?=$dt->terjual?></td>
                    <td><?=number_format($dt->total)?></td>
                    <td><?=number_format($dt->keuntungan)?></td>
                    <td>
                        <a href="<?=base_url('admin/data_lap_bulanan/'.$dt->bulan.'-'.$dt->tahun)?>" class="btn btn-info btn-sm">
                            <span class="fa fa-bars"></span>
                            <span> Detail</span>
                        </a>
                        <a href="<?=base_url('admin/lapbulan_pdf/'.$dt->bulan.'-'.$dt->tahun)?>" class="btn btn-danger btn-sm">
                            <span class="fa fa-file-pdf"></span>
                            <span> Export PDF</span>
                        </a>
                    </td>
                <?php
                    $no++;
                    }
                ?>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<script>
    $(window).ready(function(){
        $('#lapBulan').DataTable({
            columnDefs : [
                {
                    targets : [5],
                    orderable : false,
                    searchable :false
                }
            ]
        })
    })
</script>
