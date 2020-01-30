
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
                                    <td>:Rp. {{$permohonan->biaya}}
                                    </td>
                                        
                                </tr>
                                <tr>
                                    <td>Tanggal Antar Barang</td>
                                    <td>: @foreach($permohonan->inbox as $r)
                                        {{$r->tgl_antar}}
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <td>Tanggal Terima Barang</td>
                                    <td>: {{$permohonan->pengujian->tanggal_terima}}</td>
                                </tr>
                                <tr>
                                    <td>Estimasi</td>
                                    <td>:{{$permohonan->pengujian->estimasi}} Hari</td>
                                </tr>                                
                                <tr>
                                    <td>Keterangan Uji</td>
                                    @php 
                                    $status = $permohonan->pengujian->status;
                                    @endphp
                                    @if($status == 0)
                                    <td><label class="btn btn-sm btn-warning">Pending</label></td>
                                    @elseif($status == 1)
                                    <td><label class="btn btn-sm btn-primary">Dalam Proses</label></td>
                                    @else
                                    <td><label class="btn btn-sm btn-success">Selesai</label></td>
                                    @endif
                                </tr>
                                <tr>
                                    <td>Metode Pembayaran</td>
                                    @php 
                                    $status = $permohonan->pengujian->metode_pembayaran;
                                    @endphp
                                    @if($status == 0)
                                    <td><label class="btn btn-sm btn-warning">belum dibayar</label></td>
                                    @elseif($status == 1)
                                    status<td><label class="btn btn-sm btn-primary">Cash</label></td>
                                    @else
                                    <td><label class="btn btn-sm btn-success">Transfer</label></td>
                                    @endif                                
                                    </tr>                                
                                <tr>
                                    <td>Lain-lain</td>
                                    <td>: {{$permohonan->pengujian->lainnya}}</td>
                                </tr>
                                <tr>
                                    <td>Keterangan</td>
                                    <td>: {{$permohonan->pengujian->keterangan}}</td>
                                </tr>
                              </table>
                        </div>
                        <div class="card-footer text-right">
                            <a href="{{Route('pengujianEdit',['uuid'=> $permohonan->pengujian->uuid])}}" class="btn btn-primary"><i class=""></i>  Edit Data</a>
                            @if($permohonan->pengujian->metode_pembayaran != 0)
                                <a href="{{Route('cetakNota',['id'=> $permohonan->pengujian->id])}}">Cetak Nota</a>
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

