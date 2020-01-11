<div class="container">
    <h3><?=$title?></h3>
    <hr>
    <div class="row">
        <div class="col-lg-4 col-md-4">
            <?php
            $id = isset($pegawai) ? $pegawai->id_pegawai : null;
                echo form_open_multipart($link.'/'.$id)
            ?>
                <div class="form-group">
                    <label for="foto" class="control-label">Upload Foto</label>
                    <input type="file" name="foto" id="foto" class="form-control">
                </div>
                <div class="form-group">
                    <label for="nama" class="control-label">Nama Lengkap</label>
                    <?=form_input(array(
                        'name' => 'nama',
                        'id' => 'nama',
                        'class' => 'form-control',
                        'required' => 'required',
                        'value' => isset($pegawai) ? $pegawai->nama_p : null,
                        'autofocus' => 'autofocus'
                    )) ?>
                </div>
                <div class="form-group">
                    <label class="control-label">jenis Kelamin</label>
                    <div>
                        <?=form_radio(array(
                            'name' => 'jekel',
                            'id' => 'l',
                            'required' => 'required',
                            'value' => 'l',
                            'checked' => isset($pegawai) && $pegawai->jekel_p == 'l' ? 'checked' : null, 
                        )) ?>
                        <label for="l" class="control-label"> LAKI - LAKI</label>
                        &nbsp;&nbsp;
                        <?=form_radio(array(
                            'name' => 'jekel',
                            'id' => 'p',
                            'required' => 'required',
                            'value' => 'p',
                            'checked' => isset($pegawai) && $pegawai->jekel_p == 'p' ? 'checked' : null,
                        )) ?>
                        <label for="p" class="control-label"> PEREMPUAN</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="user" class="control-label">Tempat Lahir</label>
                    <?=form_input(array(
                        'name' => 'tpt_l',
                        'id' => 'user',
                        'size' => '100',
                        'class' => 'form-control',
                        'value' => isset($pegawai) ? $pegawai->tempat_lahir_p : null,
                        'required' => 'required'
                    )) ?>
                </div>
                <div class="form-group">
                    <label for="tgl_l" class="control-label">Tanggal Lahir</label>
                    <?=form_input(array(
                        'name' => 'tgl_l',
                        'value' => isset($pegawai) ? date('Y-m-d', time($pegawai->tgl_lahir_p)) : null,
                        'class' => 'form-control',
                        'id' => 'tgl_l',
                        'placeholder' => 'format : 2018-11-01',
                        'required' => 'required'
                    ));
                    ?>
                </div>
                <div class="form-group">
                    <label for="alamat" class="control-label">Alamat</label>
                    <?=form_textarea(array(
                        'name' => 'alamat',
                        'value' => isset($pegawai) ? $pegawai->alamat_p : null,
                        'class' => 'form-control',
                        'id' => 'alamat',
                        'required' => 'required'
                    )) 
                    ?>
                </div>
                <div class="form-group">
                    <label for="telp" class="control-label">No Telepon</label>
                    <?=form_input(array(
                        'name' => 'notelp',
                        'value' => isset($pegawai) ? $pegawai->no_telp_p : null,
                        'class' => 'form-control',
                        'id' => 'telp',
                        'required' => 'required'
                    )) 
                    ?>
                </div>
                <?=form_hidden('id', isset($pegawai) ?  $pegawai->id_pegawai : null)?>
                <div>
                    <?=form_submit(array(
                        'name' => $button,
                        'value' => strtoupper($button),
                        'class' => 'btn btn-primary'
                    ))?>
                    <a href="<?=base_url('admin/data_pegawai')?>" class="btn btn-danger">BATAL</a>
                </div>
            <?php
            form_close()
            ?>
        </div>
    </div>
</div>