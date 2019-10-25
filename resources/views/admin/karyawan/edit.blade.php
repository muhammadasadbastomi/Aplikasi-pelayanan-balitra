
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
                        <div class="form-group"><label for="company" class=" form-control-label">NIP</label><input type="text" id="company" placeholder="NIP" class="form-control"></div>
                        <div class="form-group"><label for="vat" class=" form-control-label">Nama</label><input type="text" id="vat" placeholder="Nama Karyawan" class="form-control"></div>
                        <div class="form-group"><label for="street" class=" form-control-label">Jabatan</label><input type="text" id="street" placeholder="Jabatan Karyawan" class="form-control"></div>
                        <div class="form-group"><label for="select" class=" form-control-label">Status Kepegawaian</label>
                            <select name="select" id="select" class="form-control">
                                 <option value="0">Pilih Status Kepegawaian</option>
                                 <option value="1">PNS</option>
                                 <option value="2">Fungsional</option>
                                 <option value="3">Konhtrak</option>
                            </select>
                        </div>
                        <div class="form-group"><label for="city" class=" form-control-label">No Tlp</label><input type="text" id="city" placeholder="nomor Telepon" class="form-control"></div>
                        <div class="form-group"><label for="postal-code" class=" form-control-label">Tempat Lahir</label><input type="text" id="Tempat Lahir" placeholder="Postal Code" class="form-control"></div>     
                        <div class="form-group"><label for="country" class=" form-control-label">Tanggal Lahir</label><input type="date" id="country" placeholder="Country name" class="form-control"></div>
                        <div class="form-group"><label for="postal-code" class=" form-control-label">Foto</label><input type="file" id="Tempat Lahir" placeholder="Postal Code" class="form-control"></div> 
                        <div class="text-right">
                            <button id="payment-button" type="submit" class="btn"><i class="fa fa-close fa-lg"></i> Batal</span></button>
                            <button id="payment-button" type="submit" class="btn  btn-info "><i class="fa fa-save fa-lg"></i> Simpan</span></button>
                        </div>
                        </div>    
                    </form>
                </div>
            </div>
        </div>
    </div> 
</div>
                               
@endsection