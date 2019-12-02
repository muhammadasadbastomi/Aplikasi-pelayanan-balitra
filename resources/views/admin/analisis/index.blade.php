
@extends('layouts.admin')
@section('content')
<div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Data Anilis</h1>
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
                                <button href="" class="btn btn-outline-primary pull-right" id="tambah" >+ tambah data</button>
                                <a href="{{Route('pelayananCetak')}}" class="btn btn-outline-info pull-right" style="margin-right:5px;"><i class="ti-printer"></i> cetak data</a>
                            </div>
                            <div class="card-body">
                            <table id="datatable" class="table table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Kode Analisis</th>
                                        <th>Analisis</th>
                                        <th>Harga</th>
                                        <th>jenis uji</th>
                                        <th>action</th>
                                    </tr>
                                </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Kode Analisis</th>
                                    <th>Analisis</th>
                                    <th>Harga</th>
                                    <th>jenis uji</th>
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
        <div class="modal fade" id="mediumModal"  role="dialog" >
                    <div class="modal-dialog modal-lg" >
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="mediumModalLabel">Tambah Data</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            <form  method="post" action="">
                                <div class="form-group"><input type="hidden" id="id" name="id"  class="form-control"></div>
                                <div class="form-group"><label  class=" form-control-label">Kode Analisis</label><input type="text" id="kd_analisis" name="name" placeholder="Kode Analisis" class="form-control"></div>
                                <div class="form-group"><label  class=" form-control-label">Analisis</label><input type="text" id="analisis" name="price" placeholder="Analisis" class="form-control"></div>
                                <div class="form-group"><label  class=" form-control-label">Harga</label><input type="text" id="harga" name="price" placeholder="Rp." class="form-control"></div>
                                <div class="form-group">
                                <label  class=" form-control-label">Jenis Uji</label>
                                <select name="" id="" class="form-control">
                                    <option value="">ini ngambil dari data uji pelayanan</option>
                                    <option value="">ini ngambil dari data uji pelayanan</option>
                                </select></div>
                            <div class="modal-footer">
                                <button type="button" class="btn " data-dismiss="modal"> <i class="ti-close"></i> Batal</button>
                                <button id="btn-form" type="submit" class="btn btn-primary"><i class="ti-save"></i> Simpan</button>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>

      </div>  

     
 </div> 
@endsection
@section('script')
<script>
    $('#tambah').click(function(){
        $('.modal-title').text('Tambah Data');
        $('#name').val('');
        $('#price').val('');  
        $('#btn-form').text('Simpan Data');
        $('#mediumModal').modal('show');
    })
</script>
@endsection
