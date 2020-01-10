
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
            <a href="" class="text-primary" style="margin-right:5px;"> <i class="ti-printer"></i> </a>
            <a href="" class="text-danger"> <i class="ti-trash"></i> </a>
        </div>
    </div>
    <br>
    <p style="text-align: justify;" > {{$inbox->keterangan}} <b class="text-danger"> {{$inbox->permohonan->id}}</b></p>
    <br>
    <p>Harap dapat mengantar Sampel Uji pada, </p>
    <table>
        <tr>
        <td>Hari, Tanggal </td>
        <td> : Senin , 28 november 2019</td>
        </tr>
        <tr>
            <td>Tempat</td>
            <td>: Kantor Balitra Banjarbaru Jalan Kebun Karet Kelurahan Loktabat Utara, Banjarbaru Utara</td>
        </tr>
    </table>
    <br>
    <p>Sekian pemberitahuan in kami beri sampaikan , atsa perhatiannya terimakasih.</p>
</div>
</section>
</aside>
</div>
@endsection