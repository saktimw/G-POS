<h3>Data Barang</h3>
<hr>
<a href="<?= base_url('admin/add_barang'); ?>" class="btn btn-primary btn-sm">
    <span class="fa fa-lg fa-plus"></span>
    <span>Tambah Data</span>
</a>
<a href="<?= base_url('admin/export_barang');?>" class="btn tbn-sm btn-info">
    <span class="fa fa-file-excel"></span>
    <span>Export Data</span>
</a>
<div class="form-inline pull-right">
    <form action="<?=base_url('admin/import_barang')?>" method="POST" enctype="multipart/form-data">
        <input type="checkbox" id="enabledimport">
        <fieldset id="formupload" disabled="disabled" style="display: inline-block">
            <input type="file" name="file" style="display:inline-block" class="form-control" accept=".xls, .xlsx">
            <input type="submit" name="import" value="Import" class="btn btn-sm btn-info">
        </fieldset>
    </form>
</div>
<br><br>
<div class="box box-success">
    <div class="box-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="dataBarang">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Harga Awal</th>
                        <th>Harga Jual</th>
                        <th>Stok Minimal</th>
                        <th>Stok Barang</th>
                        <th>Unit</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript">
 var table;
 $(document).ready(function() {
    
    $('#enabledimport').change(function(){
        if (this.checked == true)
        {
            // console.log('aa');
            $('#formupload').prop("disabled", false);
        } 
        else if (this.checked == false)
        {
            $('#formupload').prop("disabled", true);
        }
    });

    table = $('#dataBarang').DataTable({ 
  
        processing : true,
        serverSide : true,
        order: [],
  
        ajax: {
             "url": "<?php echo site_url('admin/barang')?>",
             "type": "POST"
         },
         
         //kolom 1 - no
         "columnDefs": [
         { 
             "targets": [ 0 ],
             "orderable": false,
         },
         ],
         
        //kolom action
        "columnDefs": [
            {
                "orderable" : false,
                "targets": [ 8 ],
                "render": function(data, type, row){
                        var btn;
                        btn = "<a href=\"<?=base_url('admin/edit_barang/')?>"+data+"\" class=\"btn btn-info btn-sm\"><span class=\"fa fa-edit\"></span></a>&nbsp;<a href=\"<?=base_url('barang/del_brg/')?>"+data+"\" class=\"btn btn-danger btn-sm\" onClick=\"return confirm('Yakin ingin menghapus ?')\"><span class=\"fa fa-lg fa-trash\"></span>";

                        return btn;
                    }   
            },
            {
                "orderable" : false,
                "targets" : [ 2, 3, 4, 5, 6, 7]
            }
        ],
  
     });
  
 });
 </script>