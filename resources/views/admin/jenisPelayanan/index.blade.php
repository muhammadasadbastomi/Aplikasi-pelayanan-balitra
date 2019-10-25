
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
                                        <tr>
                                            <td>1</td>
                                            <td>Uji Padi</td>
                                            <td>Rp.250.000</td>
                                            <td>Uji ini adalah uji ...</td>
                                            <td class="text-center"> 
                                                <a href="{{Route('jenisPelayananEdit')}}" class="btn btn-sm btn-outline-info">Edit</a>
                                                <a href="" class="btn btn-sm btn-outline-danger">Hapus</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Uji Kentang</td>
                                            <td>Rp.400.000</td>
                                            <td>Uji ini adalah uji ...</td>
                                            <td class="text-center"> 
                                                <a href="{{Route('jenisPelayananEdit')}}" class="btn btn-sm btn-outline-info">Edit</a>
                                                <a href="" class="btn btn-sm btn-outline-danger">Hapus</a>
                                            </td>
                                        </tr>
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