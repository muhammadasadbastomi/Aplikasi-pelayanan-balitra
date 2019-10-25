
@extends('layouts.customer')
@section('content')

  <div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Beranda</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li class="active">Beranda</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content mt-3">
    <div class="col-sm-12">
        <div class="alert  alert-success alert-dismissible fade show" role="alert">
            <span class="badge badge-pill badge-success">Sukses Login</span>  Selamat Datang (nama)
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>

<div class="card">
<div class="card-header">
info...
</div>
<div class="card-body">
Harap Lengapi data anda , dan tunggu 1x24 jam untuk konvirmasi akun oleh admin 
</div>
<div class="card-footer text-right">
<a href="" class="btn btn-primary">Lengkapi Data anda</a>
</div>
</div>
</div> <!-- .content -->
@endsection