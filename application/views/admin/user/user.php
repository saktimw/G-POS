<div class="container">
    <h3><?=$title?></h3>
    <hr>
    <div class="row">
        <div class="col-lg-4 col-md-4">
            <?php
                $id = isset($user) ? $user->id_user : 'null';
                echo form_open($link.'/'.$id);
            ?>
                <div class="form-group">
                    <label for="nama" class="control-label">Nama</label>
                    <?=form_input(array(
                        'name' => 'nama',
                        'id' => 'nama',
                        'class' => 'form-control',
                        'required' => 'required',
                        'value' => isset($user) ? $user->nama : null,
                        'autofocus' => 'autofocus'
                    )) ?>
                </div>
                <div class="form-group">
                    <label for="user" class="control-label">Username</label>
                    <?=form_input(array(
                        'name' => 'user',
                        'id' => 'user',
                        'class' => 'form-control',
                        'value' => isset($user) ? $user->username : null,
                        'required' => 'required'
                    )) ?>
                </div>
                <div class="form-group">
                    <label for="user" class="control-label">Password</label>
                    <?=form_input(array(
                            'name' => 'pass',
                            'id' => 'pass',
                            'class' => 'form-control',
                            'value' => isset($user) ? $user->password : null,
                            'required' => 'required'
                        ))
                    ?>
                </div>
                <div class="form-group">
                    <label for="user" class="control-label">Level</label>
                    <?php
                    $option = array(
                        'null' => '-- Pilih Level Akun --',
                        'admin' => 'Admin',
                        'kasir' => 'kasir'
                    );
                    echo form_dropdown('level', $option, isset($user) ? $user->level : 'null', array(
                        'class' => 'form-control'
                    )); 
                    ?>
                </div>
                <?=form_hidden('id', isset($user) ? $user->id_user : null)?>
                <div>
                    <?=form_submit(array(
                        'name' => $button,
                        'value' => strtoupper($button),
                        'class' => 'btn btn-primary'
                    ))?>
                    <a href="<?=base_url('admin/data_user')?>" class="btn btn-danger">Data User</a>
                </div>
            <?php
            form_close()
            ?>
        </div>
    </div>
</div>