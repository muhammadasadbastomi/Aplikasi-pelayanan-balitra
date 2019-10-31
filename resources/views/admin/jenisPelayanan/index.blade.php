
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
                                <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Pelayanan</th>
                                            <th>Harga</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
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
    	getPelayanan()
	
	function getPelayanan(){
		axios({
			url: '{{route("API.pelayanan.get")}}'
		}).then((response) => {
			if (response.data.status == "error") {
				console.log(response.data.value)
				return
            }console.log(response.data);/*
            $('tbody > *').remove()
			$.each(response.data.value, function (index, value) {
				$('tbody').append(
					'<tr>' +
						'<td class="text-left">' + value.name + '</td>' +
						'<td class="text-center">' + value.price + '</td>' +
						'<td class="aksi">' +
						'<a href="#" class="btn btn-labeled btn-danger btn-xs"><i class="fa fa-trash"></i> hapus</a>' +
						'</td>' +
					'</tr>'
				)
			})*/
        })
	}
</script>
@endsection