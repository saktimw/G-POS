<div class="container-fluid">
    <h3>Detail Pegawai</h3>
    <br>
    <div class="box box-info">
        <div class="box-body">
            <div class="row">
                <div class="col-md-3 col-sm-4">
                    <img src="<?=base_url('img/foto_pegawai/'.$detail->foto_p)?>" alt="<?=$detail->foto_p?>" width="200" class="thumbnail">
                </div>
                <div class="col-md-2 col-xs-4">
                    <h4>ID Pegawai</h4>
                    <h4>Nama Lengkap</h4>
                    <h4>Jenis Kelamin</h4>
                    <h4>Tempat Lahir</h4>
                    <h4>Tanggal Lahir</h4>
                    <h4>Alamat</h4>
                    <h4>No Telepon</h4>
                </div>
                <div class="col-md-7 col-xs-7">
                    <h4>: <b><?=$detail->id_pegawai?></b></h4>
                    <h4>: <b><?=$detail->nama_p?></b></h4>
                    <h4>: <b><?=$detail->jekel_p == 'p' ? 'Perempuan' : 'Laki- Laki' ?></b></h4>
                    <h4>: <b><?=$detail->tempat_lahir_p?></b></h4>
                    <h4>: <b><?=indo_date(date('d-m-Y', time($detail->tgl_lahir_p)))?></b></h4>
                    <h4>: <b><?=$detail->alamat_p?></b></h4>
                    <h4>: <b><?=$detail->no_telp_p?></b></h4>
                </div>
            </div>
        </div>
    </div>
    <a href="<?=base_url('admin/data_pegawai')?>" class="btn btn-info btn-small">
        <span class="fa fa-file"></span>
        <span> Data Pegawai</span>
    </a>
</div>