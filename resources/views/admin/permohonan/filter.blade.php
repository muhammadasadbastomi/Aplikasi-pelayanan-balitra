
@extends('layouts.admin')
@section('content')
<div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Data permohonan</h1>
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
                                <a href="{{Route('permohonanFilter')}}" class="btn btn-outline-info pull-right" style="margin-right:5px;"><i class="ti-printer"></i> cetak Filter</a>
                                <a href="{{Route('permohonanCetak')}}" class="btn btn-outline-info pull-right" style="margin-right:5px;"><i class="ti-printer"></i> cetak data</a>
                            </div>
                            <div class="card-body">
                            <form method="post" action="">
                                <div class="form-group">
                                    <label for="">Status</label>
                                    <select class="form-control"  name="status" id="status">
                                        <option value="0">Pending</option>
                                        <option value="2">Ditolak</option>
                                    </select>
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