<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login - Sistem Point Of Sales Konter Maula</title>
    <link rel="stylesheet" href="<?=base_url('assets/adminlte/bower_components/bootstrap4/css/bootstrap.min.css')?>">
    <link rel="stylesheet" href="<?=base_url('assets/fontawesome/css/fontawesome-all.min.css')?>">
    <link rel="icon" href="<?=base_url('img/logo/giftpos.png')?>" type="image/png">

    <script src="<?=base_url('assets/js/jquery/jquery.min.js')?>"></script>
    <script src="<?=base_url('assets/sweetalert/sweetalert.min.js')?>"></script>
</head>
<body>

<div class="d-flex justify-content-center bg-info py-4">
    <span class="mx-2">
        <img src="<?=base_url('img/logo/giftpos.png')?>" alt="giftpost" width="40px">
    </span>
    <h3 class="text-white font-weight-bold mr-2">GIFT</h3>
    <h3 class="text-white font-weight-light">POS</h3>
</div>

    <div class="my-4 py-4">
    
    </div>

    <?= form_open(site_url('auth/proses_login')); ?>
        <div class='d-flex justify-content-center'>
            <div class="py-4 px-4 col-lg-4">
            <h3 class="text-center">Welcome</h3>
                <div class="card-body">
                    <div class="form-group">    
                        <?= form_label('Username');?>
                        <?= form_input(array(
                            'name'=>'user',
                            'required'=>'required',
                            'class'=>'form-control',
                            'autofocus'=>'autofocus',
                            'autocomplete'=>'off',
                            'maxlength' => '20'
                        ));?>
                    </div>
                    <div class="form-group">
                        <?= form_label('Password');?>
                        <?= form_password(array(
                            'name'=>'pass',
                            'required'=>'required',
                            'class'=>'form-control',
                            'maxlength' => '20'
                        ));?>
                    <?= form_submit(array(
                        'name'=>'login',    
                        'value'=>'Login',
                        'class'=>'btn btn-info btn-block my-4',
                        'maxlength' => '20'
                    ));?>
                    </div>
                </div>
                </div>
        </div>
    <?=form_close();?>
</body>
<script src="<?= base_url('assets/adminlte/bower_components/bootstrap4/js/bootstrap.min.js')?>"></script>

<?php if ($this->session->flashdata('failed')) {?>   
  <script type="text/javascript">
    $(function(){
        swal("Username Dan Password Salah", "Coba Cek kembali username dan password", "error");
    });
  </script>
<?php }?>

</html>