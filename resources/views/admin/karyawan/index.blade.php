
@extends('layouts.admin')
@section('content')
<div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Data karyawan</h1>
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
                                <a href="" class="btn btn-outline-success pull-right" style="margin-right:5px;"><i class="ti-printer"></i> cetak data</a>
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>NIP</th>
                                            <th>Nama</th>
                                            <th>Jabatan</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>122112  3121 1 098</td>
                                            <td>Tri Angga</td>
                                            <td>Kepala Balai</td>
                                            <td>PNS</td>
                                            <td class="text-center"> 
                                                <a href="{{Route('karyawanInfo')}}" class="btn btn-sm btn-outline-primary">Info</a>
                                                <a href="{{Route('karyawanEdit')}}" class="btn btn-sm btn-outline-info">Edit</a>
                                                <a href="" class="btn btn-sm btn-outline-danger">Hapus</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td>122112  2138 1 098</td>
                                            <td>Tomy</td>
                                            <td>Sekertaris</td>
                                            <td>PNS</td>
                                            <td class="text-center"> 
                                                <a href="{{Route('karyawanInfo')}}" class="btn btn-sm btn-outline-primary">Info</a>
                                                <a href="{{Route('karyawanEdit')}}" class="btn btn-sm btn-outline-info">Edit</a>
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
                                <div class="form-group"><label for="company" class=" form-control-label">NIP</label><input type="text" id="company" placeholder="NIP" class="form-control"></div>
                                <div class="form-group"><label for="vat" class=" form-control-label">Nama</label><input type="text" id="vat" placeholder="Nama Karyawan" class="form-control"></div>
                                <div class="form-group"><label for="street" class=" form-control-label">Jabatan</label><input type="text" id="street" placeholder="Jabatan Karyawan" class="form-control"></div>
                                <div class="form-group"><label for="select" class=" form-control-label">Status Kepegawaian</label>
                                    <select name="select" id="select" class="form-control">
                                        <option value="0">Pilih Status Kepegawaian</option>
                                        <option value="1">PNS</option>
                                        <option value="2">Fungsional</option>
                                        <option value="3">Konhtrak</option>
                                    </select>
                               </div>
                                <div class="form-group"><label for="city" class=" form-control-label">No Tlp</label><input type="text" id="city" placeholder="nomor Telepon" class="form-control"></div>
                                <div class="form-group"><label for="postal-code" class=" form-control-label">Tempat Lahir</label><input type="text" id="Tempat Lahir" placeholder="Postal Code" class="form-control"></div>     
                                <div class="form-group"><label for="country" class=" form-control-label">Tanggal Lahir</label><input type="date" id="country" placeholder="Country name" class="form-control"></div>
                                <div class="form-group"><label for="postal-code" class=" form-control-label">Foto</label><input type="file" id="Tempat Lahir" placeholder="Postal Code" class="form-control"></div>     
                                      
                            <div class="modal-footer">
                                <button type="button" class="btn " data-dismiss="modal"> <i class="ti-close"></i> Batal</button>
                                <button type="button" class="btn btn-primary"><i class="ti-save"></i> Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
@endsection