@extends('layouts.main')
@section('title','Jadwal Pertandingan')
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Jadwal Pertandingan</h1>
        </div>
        <div class="card shadow mb-4">
            <div class="card-body">
                <a class="btn btn-primary" id="btn-add-data" style="margin-bottom:30px"><i class="fas fa-plus"></i> Tambah Data</a>
                <table id="tbl" class="table table-stripped" style="min-width:99% !important;">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>TIM TUAN RUMAH</th>
                            <th>TIM TAMU</th>
                            <th>JADWAL PERTANDINGAN</th>
                            <th>SKOR</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>

    </div>
{{-- @include('jadwal.modal'); --}}
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
            "url": "{{url('/statistic/match')}}",
            "type": "GET"
        },
        columns: [{
                    data: null,
                    name: "NO",
                    sortable: false,
                    searchable: false
                },
                {
                    data: "home.nama_tim",
                    name: "home.nama_tim",
                    sortable: false,
                    searchable: false
                },
                {
                    data: "away.nama_tim",
                    name: "away.nama_tim",
                    sortable: false,
                    searchable: false
                },
                {
                    data: "date",
                    name: "date",
                    sortable: false,
                    searchable: false
                },
                {
                    data: null,
                    name: "ACTION",
                    sortable: false,
                    searchable: false,
                    render:function(data){
                        var home = 0;
                        var away = 0;
                        
                        data.goal.forEach(function(val){
                            val.goal.team_id == data.home_id ? home++ : away++ ;
                        });
                        return `${home} : ${away}`;
                    }
                },
                {
                    data: null,
                    name: "ACTION",
                    sortable: false,
                    searchable: false,
                    render:function(data){
                        return '<a class="btn btn-success btn-sm btn-edit">Detail</a>';
                    }
                }]
    });

    table.on( 'order.dt search.dt', function () {
        table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();

</script>
@endsection