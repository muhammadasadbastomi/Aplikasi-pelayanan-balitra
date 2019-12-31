
@extends('layouts.customer')
@section('content')

  <div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>profil</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li class="active">Edit Data</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content mt-3">
<div class="card">
<div class="card-header">
Ubah Data Anda ...
</div>
<div class="card-body">
<form action="" method="post">
    <div class="form-group">
        <label for="">Nama </label>
        <input type="text" class="form-control" placeholder="nama kustomer">
    </div>
    <div class="form-group">
        <label for="">Nomor Telepon </label>
        <input type="text" class="form-control" placeholder="No Telp">
    </div>
    <div class="form-group">
        <label for="">Alamat </label>
        <textarea name="" id="" class="form-control"></textarea>
    </div>
</form>
</div>
<div class="card-footer text-right">
<a href="" class="btn btn-primary">Ubah Data</a>
</div>
</div>
</div> <!-- .content -->
@endsection