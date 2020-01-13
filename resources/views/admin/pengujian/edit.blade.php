
@extends('layouts.admin')
@section('content')
<div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Detail Pengujian</h1>
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
                            </div>
                            <div class="card-body">
                             <form action="post">
                                <input type="hidden" name="pengujian_id" id="pengujian_id" value="{{$pengujian->id}}">
                                <div class="form-group">
                                    <label for="">Tanggal Terima Barang</label>
                                    <input type="date" class="form-control" name="tanggal_terima" id="tanggal_terima">
                                </div>
                                <div class="form-group">
                                    <label for="">Estimasi</label>
                                    <input type="text" class="form-control" name="estimasi" id="estimasi">
                                </div>                                
                                <div class="form-group">
                                    <label for="">Keterangan Uji</label>
                                    <select class="form-control" name="status" id="status">
                                        <option value="0">Pending</option>
                                        <option value="1">Proses Pengujian</option>
                                        <option value="2">Selesai</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Metode Pembayaran</label>
                                    <select class="form-control" name="metode_pembayaran" id="metode_pembayaran">
                                        <option value="0">Cash</option>
                                        <option value="1">Transfer</option>
\                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Lainnya</label>
                                    <input type="text" class="form-control" name="lainnya" id="lainnya">
                                </div>                                  
                                <div class="form-group">
                                    <label for="">Keterangan</label>
                                    <textarea  class="form-control" name="keterangan" id="keterangan"></textarea>
                                </div>  
                             </form>
                        </div>
                        <div class="card-footer text-right">
                            <a href="" class="btn btn-primary"><i class=""></i>  Edit Data</a>
                        </div>
                    </div>
                </div>
            </div><!-- .animated -->
        </div><!-- .content -->
 </div> 
@endsection
@section('script')
    <script>
        
    </script>
@endsection

