
@extends('layouts.admin')
@section('content')
<div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Data permohonan</h1>
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
                                <form action="" method="post">
                                    <div class="form-group">
                                        <label for="">Status Permohonan</label>
                                        <select class="form-control" name="status" id="status">
                                            <option value="0">Pending</option>
                                            <option value="1"> Diterima</option>
                                            <option value="2">Ditolak</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Tanggal Antar</label>
                                        <input type="date" name="tgl_antar" id="tgl_antar" class="form-control"></input>
                                    </div>
                                    <div class="form-group">
                                        <label for="">kererangan verifikasi</label>
                                        <textarea name="keterangan" id="keterangan" class="form-control"></textarea>
                                    </div>
                                    <input type="hidden" id="permohonan_id" name="permohonan_id" value="{{$permohonan->id}}">
                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary" type="submit" name="submit" id="btn-form"> Kirim Verfikasi</button>
                            </div>
                            @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </div><!-- .animated -->
        </div><!-- .content -->
 </div> 
@endsection
@section('script')
    <script>
                //event form submit 
                $("form").submit(function (e) {
                    e.preventDefault()
                    let form = $('#modal-body form');
                        $.ajax({
                            url: "{{Route('API.pengujian.create')}}",
                            type: "post",
                            data: $(this).serialize(),
                            success: function (response) {
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'Your work has been saved',
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                            },
                            error:function(response){
                                console.log(response);
                            }
                        })
                } );
                } );
    </script>
@endsection
