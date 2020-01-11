<h3><?=$title?> Data Barang</h3>
<hr>
<div class="container">
    <div class="row">
        <div class="col-lg-4 col-md-4">
            <?php
                $id = isset($db) ? $db->kd_barang : null;
                echo form_open(base_url($link.'/'.$id)); 
            ?>
                <div class="form-group">
                    <label for="kd_b" class="control-label">Kode Barang</label>
                    <?= form_input(array(
                        'name' => 'kd_brg',
                        'value' => isset($db) ? $db->kd_barang : null,
                        'required' => 'required',
                        'placeholder' => 'Masukan Kode Barang',
                        'class' => 'form-control',
                        'autofocus' => 'autofocus',
                        'id' => 'kd_b'
                    ))?>
                </div>
                <div class="form-group">
                    <label for="nm_b" class="control-label">Nama Barang</label>                          
                    <?=form_input(array(
                        'name' => 'nama_brg',
                        'value' => isset($db) ? $db->nama_b : null,
                        'required' => 'required',
                        'placeholder' => 'Masukan Nama Barang',
                        'class' => 'form-control',
                        'id' => 'nm_b'
                    ))?>
                </div>
                <div class="form-group">
                    <label for="ha_b" class="control-label">Harga Awal Barang</label>
                    <?=form_input(array(
                        'name' => 'h_awal',
                        'value' => isset($db) ? $db->harga_awal_b : null,
                        'required' => 'required',
                        'placeholder' => '100000',
                        'class' => 'form-control',
                        'id' => 'ha_b'
                    ));?>
                </div>
                <div class="form-group">
                    <label for="" class="control-label">Harga Jual Barang</label>
                    <?=form_input(array(
                        'name' => 'h_jual',
                        'value' => isset($db) ? $db->harga_jual_b : null,
                        'required' => 'required',
                        'placeholder' => '150000',
                        'class' => 'form-control'
                    ))?>
                </div>
                <div class="form-group">
                    <label for="stok_min" class="control-label">Stok Minimum (untuk notif)</label>
                    <?=form_input(array(
                        'name' => 'stok_min',
                        'value' => isset($db) ? $db->stok_min_b : null,
                        'required' => 'required',
                        'placeholder' => '7',
                        'class' => 'form-control',
                        'id' => 'stok_min'
                    ))?>
                </div>
                <div class="form-group">
                    <label for="stok" class="control-label">Stok Barang</label>
                    <?=form_input(array(
                        'name' => 'stok',
                        'value' => isset($db) ? $db->stok_b : null,
                        'required' => 'required',
                        'placeholder' => '30',
                        'class' => 'form-control',
                        'id' => 'stok'
                    ))?>
                </div>
                <div class="form-group">
                    <label for="unit" class="control-label">Unit Barang</label>
                    <?= form_input(array(
                        'name' => 'unt_brg',
                        'value' => isset($db) ? $db->unit_b : null,
                        'required' => 'required',
                        'placeholder' => 'PCS / PACK',
                        'class' => 'form-control',
                        'id' => 'unit'
                    ))?>
                </div>
                <?=form_hidden('id', isset($db) ? $db->id_barang : null)?>
                <?= form_submit(array(
                    'name' => $button,    
                    'value' => strtoupper($button).' BARANG',
                    'class' => 'btn btn-success my-4'
                ))?>
                <a href="<?=base_url('admin/data_barang')?>" class="btn btn-primary">LIHAT BARANG</a>
            <?= form_close(); ?>
        </div>
    </div>
</div>
</body>
</html>