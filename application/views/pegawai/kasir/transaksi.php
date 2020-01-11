<style>
    #cart .form-control {
        background-color: white;
    }
</style>
<div class="box box-success">
    <br>
    <div class="box-body">
        <div class="row">
            <div class="form-group col-md-3">
                <label for="namaBrg">Nama Barang</label>
                <select name="nama_barang" id="namaBrg" class="form-control"></select>
                <input type="hidden" id="id">
            </div>
            <div class="form-group col-md-1">
                <label for="stok">Stok</label>
                <input type="text" id="stok" class="form-control" readonly>
            </div>
            <div class="form-group col-md-2">
                <label for="harga">Harga Barang</label>
                <input type="text" name="harga" id="harga" value="" class="form-control" placeholder="Harga">
                <input type="hidden" id="h_awal">
            </div>
            <div class="form-group col-md-2">
                <label for="qty">Qty</label>
                <input type="number" name="qty" id="qty" value="" min="1" class="form-control" placeholder="qty" required>
            </div>
            <div class="form-group col-md-2">
                <label for="total">Total Harga</label>
                <input type="number" name="total" id="total" value="" class="form-control" placeholder="Total" readonly>
            </div>
            <br>
            <div class="form-group col-md-2">
                <button id="tambah" class="btn btn-primary btn-sm" disabled>
                    <span class="fa fa-shopping-cart"></span>
                    <span> Tambah Ke Cart</span>
                </button>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h4><span class="fa fa-shopping-cart"></span> Cart Pembelian</h4>
            </div>
            <div class="col-md-6">
                <input type="hidden" id="stotal" value="0">
                <h4>Total : Rp. 
                    <span id="vtotal">0</span>
                </h4>
            </div>
        </div>
        <hr>
        <form action="" method="POST">
            <input type="hidden" id="alltotal" value="0">
            <input type="hidden" value="1" id="no">
            <div class="container">
                <div id="cart"></div>
            </div>
            <div class="container">
                <button type="submit" name="beli" class="btn btn-sm btn-primary" id="buy">
                    <span class="fa fa-plus"></span>
                    <span> BELI</span>
                </button>
            </div>
            <hr>
        </form>
    </div>
</div>

<div class="box box-warning">
    <div class="box-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered" id="dataTransaksi">
                <thead>
                    <tr>
                        <th>No </th>
                        <th>ID Transaksi </th>
                        <th>Tanggal </th>
                        <th>Sub Total </th>
                        <th>Aksi </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
function del(no)
{
    var stotal = parseInt($('#harga'+no).val());
    var alltotal = parseInt($('#alltotal').val());
    var newtotal = alltotal - stotal;

    $('#stotal').val(newtotal);
    $('#alltotal').val(newtotal);
    $('#vtotal').text(numeral(newtotal).format('0,0'));
    $('#row'+no).remove();
}

var table;
$(document).ready(function() {
    $('#buy').prop("disabled", true);

    $('#namaBrg').select2({
        ajax : {
            url : '<?=base_url('kasir/namadankode_barang')?>',
            type : 'POST',
            dataType : 'JSON',
            data : function(params){
                return{
                    data : params.term
                };
            },
            processResults : function(data){
                var results = [];

                $.each(data, function(index, item){
                    results.push({
                        id : item.id_barang,
                        text : item.nama_b
                    })
                });
                return {
                    results : results
                };
            }
        }
    }).on('select2:select', function (evt) {
         var nm = $("#namaBrg option:selected").text();
         $.ajax({
            type : 'POST',
            url : '<?=base_url('kasir/get_barang')?>',
            data : {data : nm},
            dataType : 'JSON',
            success : function(res){
                $('#id').val(res[0].id_barang);
                $('#h_awal').val(res[0].harga_awal_b);
                $('#harga').val(res[0].harga_jual_b);
                $('#stok').val(res[0].stok_b);
                $('#qty').val(1);
                
                var harga = $('#harga').val();
                var qty = parseInt($('#qty').val());

                var total = harga * qty;
                $('#total').val(total);
                $('#tambah').prop("disabled", false);
            }
        })
    });

    $('#harga').on('keyup', function(){
        var harga = $(this).val();
        var qty = parseInt($('#qty').val());
        var stok = parseInt($('#stok').val());
        var total = harga * qty;

        $('#total').val(total);
    })

    $('#qty').on('keyup', function(){
        var harga = $('#harga').val();
        var qty = parseInt($('#qty').val());
        var stok = parseInt($('#stok').val());
        var total = harga * qty;

        $('#total').val(total);

        // if (qty > stok)
        // {
        //     $('#tambah').prop('disabled', true);
        // }
        // else
        // {
        //     $('#tambah').prop('disabled', false);
        // }
    })

    $('#qty').on('click', function(){
        var harga = $('#harga').val();
        var qty = parseInt($('#qty').val());
        var stok = parseInt($('#stok').val());
        var total = harga * qty;

        $('#total').val(total);

        // if (qty > stok)
        // {
        //     $('#tambah').prop('disabled', true);
        // }
        // else
        // {
        //     $('#tambah').prop('disabled', false);
        // }
    })

    $('#tambah').on('click', function(){
        var no = $('#no').val();
        var stotal = parseInt($('#stotal').val());

        var nmbrg = $('#namaBrg option:selected').text();
        var harga = $('#harga').val();
        var h_awal = $('#h_awal').val();
        var qty = $('#qty').val();
        var total = $('#total').val();
        var idbrg = $('#id').val();

        var list = '<div class="row" id="row'+ no +'" style="margin-bottom:10px;">'
                        +'<div class="col-md-4">'
                            +'<input name="nama[]" class="form-control" id="nama'+ no +'" readonly>'
                            +'<input type="hidden" name="id_barang[]" id="idbrg'+ no +'">'
                        +'</div>'
                        +'<div class="col-md-2">'
                            +'<input name="harga_jual[]" class="form-control" id="harga'+ no +'" readonly>'
                            +'<input type="hidden" name="harga_awal[]" id="hrg_awal'+ no +'">'
                        +'</div>'
                        +'<div class="col-md-2">'
                            +'<input name="qty[]" class="form-control" id="qty'+ no +'" readonly>'
                        +'</div>'
                        +'<div class="col-md-2">'
                            +'<input name="subtotal[]" class="form-control" id="subtotal'+ no +'" readonly>'
                        +'</div>'
                        +'<button type="button"class="btn btn-danger btn-sm" onClick="del('+no+');">'
                            +'<b>X</b>'
                        +'</button>'
                    +'</div>';
        $('#cart').append(list);

        $('#nama'+no).val(nmbrg);  
        $('#idbrg'+no).val(idbrg);  
        $('#harga'+no).val(harga);  
        $('#hrg_awal'+no).val(h_awal);  
        $('#qty'+no).val(qty);  
        $('#subtotal'+no).val(total);

        stotal += parseInt(total);
        $('#stotal').val(stotal);
        $('#alltotal').val(stotal);
        $('#vtotal').text(numeral(stotal).format('0,0'));

        var no = (no-1) + 2;
        $('#no').val(no);
        $('#buy').prop("disabled", false)
    })

  
    table = $('#dataTransaksi').DataTable({ 
  
        processing : true,
        serverSide : true,
        order: [],
  
        ajax: {
             "url": "<?php echo site_url('kasir/ajaxTransaksi')?>",
             "type": "POST"
        },
        "columnDefs": [
            {
                "orderable" : false,
                "targets": [ 4 ],
                "render": function(data, type, row){
                    var btn;
                    btn = "<a href=\"<?=base_url('kasir/detail_transaksi/')?>"+data+"\" class=\"btn btn-info btn-sm\"><span class=\"fa fa-bars\"></span><span> Detail</span></a>&nbsp;&nbsp;<a href=\"<?=base_url('kasir/del_pembelian/')?>"+data+"\" onClick=\"return confirm('Yakin Menghapus Data Ini ?') \" class=\"btn btn-danger btn-sm\"><span class=\"fa fa-trash\"></span><span> Hapus</span></a>";
                    return btn;
                }   
            }
        ]
    });
 });
</script>