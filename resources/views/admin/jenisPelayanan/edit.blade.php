
@extends('layouts.admin')
@section('content')
<div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Edit Karyawan</h1>
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
        <div class="col-lg-12">
            <div class="card">
                 <div class="card-header">
                   <strong class="card-title">Form Edit</strong>
                </div>
                <div class="card-body">
                   <div id="pay-invoice">
                  <div class="card-body">
                     <hr>
                    <form action="" method="post" novalidate="novalidate">
                                <div class="form-group"><label for="company" class=" form-control-label">Nama Pelayanan</label><input type="text" id="company" placeholder="Uji ..." class="form-control"></div>
                                <div class="form-group"><label for="vat" class=" form-control-label">Harga Uji(Rp.)</label><input type="text" id="vat" placeholder="" class="form-control"></div>
                                <div class="form-group"><label for="street" class=" form-control-label">Keterangan</label><textarea name="" id="" class="form-control"></textarea></div>                                      
                            <div class="card-footer text-right">
                                <button type="button" class="btn " data-dismiss="modal"> <i class="ti-close"></i> Batal</button>
                                <button type="button" class="btn btn-primary"><i class="ti-save"></i> Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div> 
</div>
                               
@endsection