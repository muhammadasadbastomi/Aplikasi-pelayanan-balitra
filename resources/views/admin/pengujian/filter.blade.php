
@extends('layouts.admin')
@section('content')
<div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Data Pengujian</h1>
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
                        <div class="c,ard">
                            <div class="card-header">
                                <strong class="card-title">Filter Waktu</strong>
                            </div>
                            <div class="card-body">
                            <form method="post" action="">
                                <div class="form-group">
                                    <label for="">Tanggal Awal</label>
                                   <input type="date" class="form-control" name="tanggal_awal">
                                </div>
                                <div class="form-group">
                                    <label for="">Tanggal Akhir</label>
                                   <input type="date" class="form-control" name="tanggal_akhir">
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button type="submit"  name="submit" class="btn btn-primary"> Cetak Data </button>
                                {{ csrf_field() }}                                    
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- .animated -->
        </div><!-- .content -->
        
 </div> 
@endsection