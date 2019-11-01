
@extends('layouts.admin')
@section('content')
<div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Data Jenis Pelayanan</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="{{Route('adminIndex')}}">Beranda</a></li>
                            <li class="active">Pemohon</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Tabel Data</strong>
                                <a href="" class="btn btn-outline-primary pull-right"  data-toggle="modal" data-target="#mediumModal" >+ tambah data</a>
                                <a href="" class="btn btn-outline-info pull-right" style="margin-right:5px;"><i class="ti-printer"></i> cetak data</a>
                            </div>
                            <div class="card-body">
                            <table id="datatable" class="table table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Nama Pelayanan</th>
                                        <th>Harga</th>
                                        <th>action</th>
                                    </tr>
                                </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Nama Pelayanan</th>
                                    <th>Harga</th>
                                    <th>action</th>
                                </tr>
                            </tfoot>
                            </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- .animated -->
        </div><!-- .content -->
        <div class="modal fade" id="mediumModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="mediumModalLabel">Tambah Data</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            <form action="">
                                <div class="form-group"><label for="company" class=" form-control-label">Nama Pelayanan</label><input type="text" id="company" placeholder="Uji ..." class="form-control"></div>
                                <div class="form-group"><label for="vat" class=" form-control-label">Harga Uji(Rp.)</label><input type="text" id="vat" placeholder="" class="form-control"></div>
                                <div class="form-group"><label for="street" class=" form-control-label">Keterangan</label><textarea name="" id="" class="form-control"></textarea></div>                                      
                            <div class="modal-footer">
                                <button type="button" class="btn " data-dismiss="modal"> <i class="ti-close"></i> Batal</button>
                                <button type="button" class="btn btn-primary"><i class="ti-save"></i> Simpan</button>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
@endsection
@section('script')
<script>
$(document).ready(function() {
    $('#datatable').DataTable( {
        responsive: true,
            processing: true,
            serverSide: false,
            searching: true,
            ajax: {
            "type": "GET",
            "url": "{{route('API.pelayanan.get')}}",
            "dataSrc": "data",
            "contentType": "application/json; charset=utf-8",
            "dataType": "json",
            "processData": true
        },
        "fnDrawCallback": function () {
            console.log(this.fnSettings().fnRecordsTotal());
        },
        columns: [
            {"data": "name"},
            {"data": "price"},
            {data: "id" , render : function ( data, type, row, meta ) {
                return type === 'display'  ?
                '<a href="" class="btn btn-sm btn-outline-primary" ><i class="ti-pencil"></i></a> <a href="" class="btn btn-sm btn-outline-danger" > <i class="ti-trash"></i></a>':
                data;
            }}
        ]
    });
} );
/*{data: "id" , render : function ( data, type, row, meta ) {
                return type === 'display'  ?
                '<a href="" class="btn btn-sm btn-outline-primary" ><i class="ti-pencil"></i></a> <a href="" class="btn btn-sm btn-outline-danger" > <i class="ti-trash"></i></a>':
                data;
            }},*/
</script>
@endsection
