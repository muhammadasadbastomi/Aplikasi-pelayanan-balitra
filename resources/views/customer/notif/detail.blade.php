
@extends('layouts.customer')
@section('content')
<br>
<br>
<div class="col-md-12">
<aside class="profile-nav alt">
<section class="card">
<div class="card-header user-header alt bg-light">
<p>Detail Pembertahuan</p>
</div>
<div class="card-body">
    <div class="row">
        <div class="col-md-4">
        <table>
            <tr>
                <td> Pengirim</td>
                <td> : Admin</td>
            </tr>
            <tr>
            <td>Waktu</td>
            <td> : {{$inbox->created_at}}</td>
            </tr>
            <tr>
                <td>Subject</td>
                <td>: {{$inbox->subject}}</td>
            </tr>
        </table>
        </div>
        <div class="col-md-8 text-right">
            <a href="{{Route('notifCetak',['id'=>$inbox->id])}}" class="text-primary" style="margin-right:5px;"> <i class="ti-printer"></i> </a>
        </div>
    </div>
    <br>
    <p style="text-align: justify;" >Permohonan pengujiian {{$inbox->permohonan->user->name}} yang diajukan pada tanggal {{$inbox->permohonan->created_at}} telah di verifikasi oleh admin dab dinyatakan @if($inbox->permohonan->id = 1) <b class="text-danger">DITERIMA</b>@else  <b class="text-danger">DITOLAK</b> @endif dengan keterangan :{{$inbox->keterangan}} </p>
    <br>
    <p>Harap dapat mengantar Sampel Uji pada, </p>
    <table>
        <tr>
        <td> Tanggal </td>
        <td> : {{ date('d-m-Y', strtotime($inbox->tgl_antar)) }} </td>
        </tr>
        <tr>
            <td>Tempat</td>
            <td>: Kantor Balitra Banjarbaru Jalan Kebun Karet Kelurahan Loktabat Utara, Banjarbaru Utara</td>
        </tr>
    </table>
    <br>
    <p>Sekian pemberitahuan ini kami beri sampaikan ,anda dapat mencetak pesan ini sebagai bukti bahwa permohonan anda telah disetujui atas perhatiannya terimakasih.</p>
</div>
</section>
</aside>
</div>
@endsection