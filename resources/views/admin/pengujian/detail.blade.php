
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
                                <a href="{{Route('permohonanCetak')}}" class="btn btn-outline-info pull-right" style="margin-right:5px;"><i class="ti-printer"></i> cetak data</a>
                            </div>
                            <div class="card-body">
                              <table class="table table-hover table-bordered">
                                <tr>
                                    <td width="250">Permohonan</td>
                                    <td>: {{$permohonan->user->name}}</td>
                                </tr>
                                <tr>
                                    <td>jenis Pelayanan</td>
                                    <td>: {{$permohonan->jenispelayanan->jenis}}</td>
                                </tr>
                                <tr>
                                    <td width="250">Analisis</td>
                                    <td style="padding-left:30px;">
                                    <ul>
                                    @foreach($permohonan->detail_permohonan as $a)
                                    <li>{{$a->pelayanan->name}} - Rp.{{$a->pelayanan->price}} </li>
                                    @endforeach
                                    </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Biaya</td>
                                    <td>: @foreach($permohonan->detail_permohonan as $a)
                                        @php
                                        $total = $a->pelayanan->sum('price');
                                        @endphp
                                        @endforeach
                                        {{ $total }}
                                    </td>
                                        
                                </tr>
                                <tr>
                                    <td>Tanggal Antar Barang</td>
                                    <td>: </td>
                                </tr>
                                <tr>
                                    <td>Tanggal Terima Barang</td>
                                    <td>:</td>
                                </tr>
                                <tr>
                                    <td>Estimasi</td>
                                    <td>:</td>
                                </tr>                                
                                <tr>
                                    <td>Keterangan Uji</td>
                                    <td>:</td>
                                </tr>
                                <tr>
                                    <td>Metode Pembayaran</td>
                                    <td>:</td>
                                </tr>                                
                                <tr>
                                    <td>Lain-lain</td>
                                    <td>:</td>
                                </tr>
                                <tr>
                                    <td>Keterangan</td>
                                    <td>:</td>
                                </tr>
                              </table>
                        </div>
                        <div class="card-footer text-right">
                            <a href="" class="btn">Edit Data</a>
                            @if($permohonan->pengujian->metode_pembayaran != 0)
                                <a href="">Cetak Nota</a>
                            @endif
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

