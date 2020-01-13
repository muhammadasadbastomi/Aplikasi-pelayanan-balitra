
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
</div>
<div class="card-body">
<form action="" method="post">
    <div class="form-group">
        <label for="">Nama </label>
        <input type="text" class="form-control" name="nama" placeholder="nama kustomer" value="{{$customer_data->nama}}">
    </div>
    <div class="form-group">
        <label for="">Nomor Telepon </label>
        <input type="text" class="form-control"  name="telepon" placeholder="No Telp" value="{{$customer_data->telepon}}">
    </div>
    <div class="form-group">
        <label for="">Alamat </label>
        <textarea name="alamat" id="" class="form-control">{{$customer_data->alamat}}</textarea>
    </div>
</div>
<div class="card-footer text-right">
<button type="submit" class="btn btn-primary">Simpan Data</button>
{{ csrf_field() }}                                    
</form>
</div>
</div>
</div> <!-- .content -->
@endsection