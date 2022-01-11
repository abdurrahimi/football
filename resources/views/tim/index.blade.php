@extends('layouts.main')
@section('title','Team')
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Team</h1>
        </div>
        <div class="card shadow mb-4">
            <div class="card-body">
                <a class="btn btn-primary" id="btn-add-data" style="margin-bottom:30px"><i class="fas fa-plus"></i> Tambah Data</a>
                <table id="tbl" class="table table-stripped" style="min-width:99% !important;">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>NAMA TIM</th>
                            <th>TAHUN BERDIRI</th>
                            <th>KOTA</th>
                            <th>ALAMAT</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>

    </div>
@include('tim.modal');
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
            "url": "{{url('/team-data/')}}",
            "type": "GET"
        },
        columns: [{
                    data: null,
                    name: "NO",
                    sortable: false,
                    searchable: false
                },
                {
                    data: "nama_tim",
                    name: "nama_tim",
                    sortable: false,
                    searchable: false
                },
                {
                    data: "tahun_berdiri",
                    name: "tahun_berdiri",
                    sortable: false,
                    searchable: false
                },
                {
                    data: "kota",
                    name: "kota",
                    sortable: false,
                    searchable: false
                },
                {
                    data: "alamat",
                    name: "alamat",
                    sortable: false,
                    searchable: false
                },
                {
                    data: null,
                    name: "ACTION",
                    sortable: false,
                    searchable: false,
                    render:function(data){
                        return '<a href="{{url("/tim-data/player-list")}}/'+data.id+'" class="btn btn-warning btn-sm">Data Pemain</a>&nbsp;<a class="btn btn-success btn-sm btn-edit">Edit</a>&nbsp;<a class="btn btn-danger btn-delete btn-sm">Hapus</a>';
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
        $('#form')[0].reset();
        $('#modal').modal("show");
    })

    $(document).on('click', '.btn-edit', function(){
        var data = table.row($(this).closest('tr')).data();
        $.each(data,function(key,val){
            $('input[name="'+key+'"]').val(val)
            $('textarea[name="'+key+'"]').val(val)
        })
        $('#modal').modal('show');
    });

    $(document).on('click', '.btn-delete', function(){
        var data = table.row($(this).closest('tr')).data();
        if(confirm("Yakin Menghapus Data?")){
            $.ajax({
                url: "{{url('tim/delete')}}/"+data.id,
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
        $('.btn-submit').prop('disabled',true);
        $('.btn-submit').text('Loading...');
        var datas = $('#form').serializeArray();
        var data = {};

        $.each(datas, function() {
            data[this.name] = this.value;
        });
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method  : 'post',
            url     : "{{url('tim/store')}}",
            dataType: 'json',
            data    : data,
            success: function(data) {                
                table.ajax.reload();
                alert(data.msg)
                $('.btn-submit').prop('disabled',false);
                $('.btn-submit').text('Submit');
                $('.modal').modal('hide');
                
            },
            error: function (jqXHR, textStatus, errorThrown) {
               
            }
        })
        e.preventDefault();
    })
</script>
@endsection