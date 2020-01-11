
<div class="row">
<div class="col-lg-4 col-xs-6">
  <!-- small box -->
  <div class="small-box bg-aqua">
    <div class="inner">
      <h3><?=$jumlah_transaksi ?: 0?></h3>

      <p>Jumlah Transaksi</p>
    </div>
    <div class="icon">
      <i class="ion ion-arrow-swap"></i>
    </div>
  </div>
</div>
<div class="col-lg-4 col-xs-6">
  <!-- small box -->
  <div class="small-box bg-yellow">
    <div class="inner">
      <h3><?=$terjual ?: 0?></h3>

      <p>Barang Terjual</p>
    </div>
    <div class="icon">
      <i class="ion ion-bag"></i>
    </div>
  </div>
</div>
<div class="col-lg-4 col-xs-6">
  <!-- small box -->
  <div class="small-box bg-green">
    <div class="inner">
      <h3><?=$top ?: 0?></h3>

      <p>Barang Terlaris</p>
    </div>
    <div class="icon">
      <i class="ion ion-pie-graph"></i>
    </div>
  </div>
</div>
</div>
<div class="box box-warning">
  <div class="box-header"><h3>Panel Stok Barang Yang Menipis</h3></div>
    <div class="box-body">
            <table class="table table-striped">
              <thead>
                <th>No.</th>
                <th>Nama Barang</th>
                <th>Stok</th>
              </thead>
              <tbody>
              <?php
                $no = 1;
                if ($stok == null)
                {
                  echo "<tr><td colspan =\"3\" align=\"center\">Data Kosong</td></tr>";
                }
                else
                {
                foreach($stok as $a){ 
              ?>
                <tr>
                  <td><?=$no?></td>
                  <td><?=$a->nama_b?></td>
                  <td><?=$a->stok_b?></td>
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
