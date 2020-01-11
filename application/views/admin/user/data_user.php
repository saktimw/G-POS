<h3>Data User</h3>
<br>
<a href="<?=base_url('admin/add_user')?>" class="btn btn-info btn-sm">
    <span class="fa fa-lg fa-plus"></span>
    <span> Tambah User</span>
</a>
<br><br>
<div class="box box-success">
<div class="box-body">
    <table class="table table-bordered" id="dataUser">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Username</th>
                <th>Password</th>
                <th>level</th>
                <th>Action</th>
            </tr>
          </thead>
          <tbody>  
            <?php

            if ($user == null)
            {
                echo "<tr>";
                echo "<td class=\"text-center\" colspan=\"6\">Data Kosong</td>";
                echo "</tr>";
            }

            $no = 1;
            foreach ($user as $du){
            ?>
            
            <tr>
                <td><?=$no?></td>
                <td><?=$du->nama?></td>
                <td><?=$du->username?></td>
                <td><?=$du->password?></td>
                <td><?=$du->level?></td>
                <td class="text-center">
                    <a href="<?=base_url('admin/edit_user/'.$du->id_user)?>" class="btn btn-warning fa fa-edit"></a>
                    <a href="<?=base_url('user/del_user/'.$du->id_user)?>" class="btn btn-danger fa fa-trash" onClick="return confirm('Yakin ingin menghapus ?')"></a>
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
                    targets : [ 3, 5 ],
                    orderable : false
                }
            ]
        })
    })
</script>
