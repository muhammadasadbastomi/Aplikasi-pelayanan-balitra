
@extends('layouts.admin')
@section('content')
<div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Data Pendapatan</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="{{Route('adminIndex')}}">Beranda</a></li>
                            <li class="active">Pendapatan</li>
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
                                <a href="{{Route('pendapatankeseluruhan')}}" class="btn btn-outline-info pull-right" style="margin-right:5px;"><i class="ti-printer"></i> pendapatan keseluruhan</a>
                                <a href="{{Route('pendapatanFilterWaktu')}}" class="btn btn-outline-info pull-right" style="margin-right:5px;"><i class="ti-printer"></i> cetak pendapatan periode waktu</a>
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Pengujian</th>
                                            <th>Kategori</th>
                                            <th>Tanggal</th>
                                            <th>Biaya</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($pendapatan as $p)
                                       <tr>
                                            <td>{{$p->permohonan->user->name}}</td>
                                            <td>{{$p->permohonan->jenispelayanan->jenis}}</td>
                                            <td>{{$p->permohonan->pengujian->created_at}}</td>
                                            <td>Rp.{{$p->biaya}}</td>
                                       </tr>
                                    @endforeach
                                    <tr>
                                    <td colspan="3">Total</td>
                                    <td ><b>Rp.{{$pendapatan->sum('biaya')}}</b></td>
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