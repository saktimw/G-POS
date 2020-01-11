<h3>Data Pegawai</h3>
<hr>
<a href="<?=base_url('admin/add_pegawai')?>" class="btn btn-info btn-sm">
    <span class="fa fa-lg fa-plus"></span>
    <span> Tambah Data Pegawai</span>
</a>
<br><br>
<div class="box box-success">
    <div class="box-body">
        <table class="table table-bordered" id="dataUser">
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Foto</th>
                    <th class="text-center">Nama Lengkap</th>
                    <th class="text-center">Alamat</th>
                    <th class="text-center">No Telepon</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>  
                <?php

                if ($pegawai == null)
                {
                    echo "<tr>";
                    echo "<td class=\"text-center\" colspan=\"6\">Data Kosong</td>";
                    echo "</tr>";
                }

                $no = 1;
                foreach ($pegawai as $dp){ 
                
                ?>
                
                <tr>
                    <td class="text-center"><?=$no?></td>
                    <td>
                        <div class="thumbnail" style="max-height:80px; max-width:80px;">
                            <img src="<?=base_url('img/foto_pegawai/'.$dp->foto_p)?>" alt="<?=$dp->foto_p?>">
                        </div>
                    </td>
                    <td><?=$dp->nama_p?></td>
                    <td><?=$dp->alamat_p?></td>
                    <td><?=$dp->no_telp_p?></td>
                    <td class="text-center">
                        <a href="<?=base_url('admin/detail_pegawai/'.$dp->id_pegawai)?>" class="btn btn-info btn-sm">
                            <span class="fa fa-bars"></span>
                            <span> Detail</span>
                        </a>
                        <a href="<?=base_url('admin/edit_pegawai/'.$dp->id_pegawai)?>" class="btn btn-warning btn-sm">
                            <span class="fa fa-edit"></span>
                            <span> Edit</span>
                        </a>
                        <a href="<?=base_url('pegawai/del_pegawai/'.$dp->id_pegawai)?>" class="btn btn-danger btn-sm" onClick="return confirm('Yakin ingin menghapus ?')">
                            <span class="fa fa-trash"></span>
                            <span> Hapus</span>
                        </a>
                    </td>
                </tr>
                <?php
                    $no++;
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    $(window).ready(function(){
        $('#dataUser').DataTable({
            columnDefs : [
                {
                    targets : [ 1, 3, 4, 5 ],
                    orderable : false
                }
            ]
        })
    })
</script>
