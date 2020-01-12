
@extends('layouts.admin')
@section('content')
<div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Data Pemohon</h1>
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
                                <a href="" class="btn btn-outline-info pull-right" style="margin-right:5px;"><i class="ti-printer"></i> cetak data</a>
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>No Telepon</th>
                                            <th>Alamat</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>PT.SEJAHTERA</td>
                                            <td>08764533432</td>
                                            <td>jL.A.yani km 31 </td>
                                            <td class="text-center">
                                                <a href="" class="btn btn-sm btn-outline-danger" >tidak aktif</a>
                                                <a href="" class="btn btn-sm btn-outline-primary">info</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>PT.ARUM</td>
                                            <td>08764533432</td>
                                            <td>jL.A.yani km 31 </td>
                                            <td class="text-center">
                                                <a href="" class="btn btn-sm btn-outline-info" >aktif</a>
                                                <a href="" class="btn btn-sm btn-outline-primary">info</a>
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
@endsection