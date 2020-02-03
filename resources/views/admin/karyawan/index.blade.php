
@extends('layouts.admin')
@section('content')
<div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Data karyawan</h1>
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
                                <a href="" class="btn btn-outline-primary pull-right"  data-toggle="modal" data-target="#mediumModal" >+ tambah data</a>
                                <!-- <a href="{{Route('karyawanCetak')}}" class="btn btn-outline-success pull-right" style="margin-right:5px;"><i class="ti-printer"></i> cetak data</a> -->
                            </div>
                            <div class="card-body">
                                <table id="datatable" class="table table-hover" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>NIP</th>
                                            <th>Nama</th>
                                            <th>Telepon</th>
                                            <th>Tempat Lahir</th>
                                            <th>Tanggal Lahir</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- .animated -->
        </div><!-- .content -->
        <div class="modal fade" id="mediumModal"  role="dialog"  >
                    <div class="modal-dialog modal-lg" >
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="mediumModalLabel">Tambah Data</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            <form action="" enctype="multipart/form-data" method="post">
                                <p>Data karywan</p>
                                <hr>
                                <div class="form-group"><input type="hidden" id="id" name="id"  class="form-control"></div>
                                <div class="form-group"><label for="company" class=" form-control-label">NIP</label><input type="text" id="NIP" name="NIP" placeholder="NIP" class="form-control"></div>
                                <div class="form-group"><label for="vat" class=" form-control-label">Nama</label><input type="text" id="name" name="name" placeholder="Nama Karyawan" class="form-control"></div>
                                <div class="form-group"><label for="city" class=" form-control-label">No Tlp</label><input type="text" id="telepon" name="telepon" placeholder="nomor Telepon" class="form-control"></div>
                                <div class="form-group"><label for="postal-code" class=" form-control-label">Tempat /Tempat Lahir</label><br>
                                    <div class="col-md-6">
                                        <input type="text" id="tempat_lahir" placeholder="Tempat Lahir" name="tempat_lahir" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="form-control">
                                    </div>
                                </div>     
                                <div class="form-group"><label for="city" class=" form-control-label">Alamat</label><textarea name="alamat" id="alamat" class="form-control"></textarea></div>
                                <p>data user</p>
                                <hr>
                                <div class="form-group"><label for="city" class=" form-control-label">Email</label><input type="email" id="email" name="email"placeholder="Email" class="form-control"></div>
                                <div class="form-group"><label for="city" class=" form-control-label">Password</label><input type="password" id="password"name="password" placeholder="" class="form-control"></div>
                                      
                            <div class="modal-footer">
                                <button type="button" class="btn " data-dismiss="modal"> <i class="ti-close"></i> Batal</button>
                                <button type="submit" class="btn btn-primary"><i class="ti-save"></i> Simpan</button>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
@endsection
@section('script')
    <script>
        //fungsi hapus
        hapus = (uuid, name) =>{
            let csrf_token=$('meta[name="csrf_token"]').attr('content');
            Swal.fire({
                        title: 'apa anda yakin?',
                        text: " Menghapus Kecamatan data " + name,
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'hapus data',
                        cancelButtonText: 'batal',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.value) {
                            $.ajax({
                                url : "{{ url('/api/karyawan')}}" + '/' + uuid,
                                type : "POST",
                                data : {'_method' : 'DELETE', '_token' :csrf_token},
                                success: function (response) {
                                    Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'Data Berhasil Dihapus',
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                            $('#datatable').DataTable().ajax.reload(null, false);
                        },
                    })
                    } else if (result.dismiss === swal.DismissReason.cancel) {
                        Swal.fire(
                        'Dibatalkan',
                        'data batal dihapus',
                        'error'
                        )
                    }
                })
            }

            
            //event btn tambah
            $('#tambah').click(function(){
                $('.modal-title').text('Tambah Data');
                $('#NIP').val('');
                $('#name').val('');
                $('#telepon').val('');
                $('#tempat_lahir').val('');  
                $('#tanggal_lahir').val('');
                $('#alamat').val('');  
                $('#email').val('');
                $('#password').val('');        
                $('#btn-form').text('Simpan Data');
                $('#mediumModal').modal('show');
            })

            //event btn edit
            edit = uuid =>{
                $.ajax({
                    type: "GET",
                    url: "{{ url('/api/karyawan')}}" + '/' + uuid,
                    beforeSend: false,
                    success : function(returnData) {
                        $('.modal-title').text('Edit Data');
                        $('#id').val(returnData.data.uuid);
                        $('#NIP').val(returnData.data.NIP);
                        $('#name').val(returnData.data.user.name);
                        $('#telepon').val(returnData.data.telepon);
                        $('#tempat_lahir').val(returnData.data.tempat_lahir);  
                        $('#tanggal_lahir').val(returnData.data.tanggal_lahir);
                        $('#alamat').text(returnData.data.alamat);  
                        $('#email').val(returnData.data.user.email);
                        $('#password').attr('placeholder','Isi jika Ingin merubah');
                        $('#btn-form').text('Ubah Data');
                        $('#mediumModal').modal('show');
                    }
                })
            }

            //fungsi render datatable
            $(document).ready(function() {
                $('#datatable').DataTable( {
                    responsive: true,
                    processing: true,
                    serverSide: false,
                    searching: true,
                    ajax: {
                        "type": "GET",
                        "url": "{{route('API.karyawan.get')}}",
                        "dataSrc": "data",
                        "contentType": "application/json; charset=utf-8",
                        "dataType": "json",
                        "processData": true
                    },
                    columns: [
                        {"data": "NIP"},
                        {"data": 'user.name'},
                        {"data": "telepon"},
                        {"data": "tempat_lahir"},
                        {"data": "tanggal_lahir"},
                        {data: null , render : function ( data, type, row, meta ) {
                            let uuid = row.uuid;
                            let name = row.user.name;
                            return type === 'display'  ?
                            '<button onClick="edit(\''+uuid+'\')" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#editmodal"><i class="ti-pencil"></i></button> <button onClick="hapus(\'' + uuid + '\',\'' + name + '\')" class="btn btn-sm btn-outline-danger" > <i class="ti-trash"></i></button>':
                        data;
                        }}
                    ]
                });

                //event form submit
                $("form").submit(function (e) {
                    e.preventDefault()
                    let form = $('#modal-body form');
                    if($('.modal-title').text() == 'Edit Data'){
                        let url = '{{route("API.karyawan.update", '')}}'
                        let id = $('#id').val();
                        $.ajax({
                            url: url+'/'+id,
                            type: "put",
                            data: $(this).serialize(),
                            success: function (response) {
                                form.trigger('reset');
                                $('#mediumModal').modal('hide');
                                $('#datatable').DataTable().ajax.reload();
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'Data Berhasil Tersimpan',
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                            },
                            error:function(response){
                                console.log(response);
                            }
                        })
                    }else{
                        $.ajax({
                            url: "{{Route('API.karyawan.create')}}",
                            type: "post",
                            data: $(this).serialize(),
                            success: function (response) {
                                form.trigger('reset');
                                $('#mediumModal').modal('hide');
                                $('#datatable').DataTable().ajax.reload();
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
                    }
                } );
                } );
    </script>
@endsection