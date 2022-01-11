@extends('layouts.main')
@section('title',$tim->nama_tim." Player List")
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{$tim->nama_tim." Player List"}}</h1>
        </div>
        <div class="card shadow mb-4">
            <div class="card-body">
                <a class="btn btn-primary" id="btn-add-data" style="margin-bottom:30px"><i class="fas fa-plus"></i> Tambah Data</a>
                <table id="tbl" class="table table-stripped" style="min-width:99% !important;">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>NAMA PEMAIN</th>
                            <th>TINGGI</th>
                            <th>POSISI</th>
                            <th>NOMOR PUNGGUNG</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>

    </div>
@include('player.modal');
@endsection
@section('script')
<script>
    var table = $('#tbl').DataTable({
        scrollX: true,
        pageLength: 10,
        lengthMenu: [
            [10, 25, 50, 100],
            [10, 25, 50, 100]
        ],
        "dom": 'lrtip',
        pagingType: 'full_numbers',
        "processing": true,
         retrieve: true,
         "language": {
                    "loadingRecords": "Memuat data..."
         },
        "ajax": {
            "headers": {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            "url": "{{url('/player-by-tim/'.$tim->id)}}",
            "type": "GET"
        },
        columns: [{
                    data: null,
                    name: "NO",
                    sortable: false,
                    searchable: false
                },
                {
                    data: "nama_pemain",
                    name: "nama_pemain",
                    sortable: false,
                    searchable: false
                },
                {
                    data: "tinggi",
                    name: "tinggi",
                    sortable: false,
                    searchable: false
                },
                {
                    data: "posisi",
                    name: "posisi",
                    sortable: false,
                    searchable: false
                },
                {
                    data: "nomor_punggung",
                    name: "nomor_punggung",
                    sortable: false,
                    searchable: false
                },
                {
                    data: null,
                    name: "ACTION",
                    sortable: false,
                    searchable: false,
                    render:function(data){
                        return '<a class="btn btn-warning btn-sm btn-transfer">Transfer</a>&nbsp;<a class="btn btn-success btn-sm btn-edit">Edit</a>&nbsp;<a class="btn btn-danger btn-delete btn-sm">Hapus</a>';
                    }
                }]
    });

    table.on( 'order.dt search.dt', function () {
        table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();

    $('#btn-add-data').on('click',function(){
        $('input[name="id"]').val("");
        $('select[name="posisi"]').val("");
        $('#form')[0].reset();
        $('#modal').modal("show");
    })

    $(document).on('click', '.btn-edit', function(){
        $('input[name="nomor_punggung"]').removeClass('is-invalid');
        var data = table.row($(this).closest('tr')).data();
        $.each(data,function(key,val){
            $('[name="'+key+'"]').val(val)
            /* $('textarea[name="'+key+'"]').val(val)
            $('select[name="'+key+'"]').val(val) */
        })
        $('#modal').modal('show');
    });

    $(document).on('click', '.btn-delete', function(){
        var data = table.row($(this).closest('tr')).data();
        if(confirm("Yakin Menghapus Data?")){
            $.ajax({
                url: "{{url('player/delete')}}/"+data.id,
                type: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    table.ajax.reload();
                    alert(data.msg)
                }
            });
        }
    });

    $('#form').on("submit",function(e){
        $('input[name="nomor_punggung"]').removeClass('is-invalid');
        $('.btn-submit').prop('disabled',true);
        $('.btn-submit').text('Loading...');
        var datas = $('#form').serializeArray();
        var data = {};

        $.each(datas, function() {
            data[this.name] = this.value;
        });
        data['team_id'] = {{$tim->id}};
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method  : 'post',
            url     : "{{url('player/store')}}",
            dataType: 'json',
            data    : data,
            success: function(data) {                
                table.ajax.reload();
                alert(data.msg)
                $('.btn-submit').prop('disabled',false);
                $('.btn-submit').text('Submit');
                if(data.result == "OK"){
                    $('.modal').modal('hide');
                }else{
                    $('input[name="nomor_punggung"]').addClass('is-invalid');
                }
                
            },
            error: function (jqXHR, textStatus, errorThrown) {
               
            }
        })
        e.preventDefault();
    })
</script>
@endsection