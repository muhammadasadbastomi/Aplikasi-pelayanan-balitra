
@extends('layouts.admin')
@section('content')
<div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Data Berita</h1>
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
                                <button href="" class="btn btn-outline-primary pull-right" id="tambah" >+ tambah data</button>
                                <!-- <a href="{{Route('beritaCetak')}}" class="btn btn-outline-info pull-right" style="margin-right:5px;"><i class="ti-printer"></i> cetak data</a> -->
                            </div>
                            <div class="card-body">
                                <table id="datatable" class=" text-center table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Judul</th>
                                            <th>Tanggal</th>
                                            <th class="text-center">Aksi</th>
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
        <div class="modal fade" id="mediumModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="mediumModalLabel">Tambah Data</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            <form action="" method="post">
                                <input type="hidden"  id="id" name="id">
                                <div class="form-group"><label for="judul" class="form-control-label">Judul</label><input type="text" name="judul" id="judul" placeholder="judul Berita" class="form-control"></div>
                                <div class="form-group"><label for="isi" class=" form-control-label">Isi</label><textarea name="isi" id="isi" class="form-control"></textarea></div>   
                                <div class="form-group"><label for="judul" class="form-control-label">Gambar</label><input type="file" name="foto" id="foto" placeholder="judul Berita" class="form-control"></div>                                   
                            <div class="modal-footer">
                                <button type="button" class="btn " data-dismiss="modal"> <i class="ti-close"></i> Batal</button>
                                <button type="submit" name="submit" class="btn btn-primary"><i class="ti-save"></i> Simpan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
@endsection
@section('script')
    <script>

                //event btn tambah klik
                $('#tambah').click(function(){
                $('.modal-title').text('Tambah Data');
                $('#judul').val('');
                var editor = new FroalaEditor('#isi', {}, function () {
                editor.html.insert('');
                })
                $('#foto').val('');  
                $('#btn-form').text('Simpan Data');
                $('#mediumModal').modal('show');
            })

            //fungsi hapus
            hapus = (uuid, nama)=>{
                let csrf_token=$('meta[name="csrf_token"]').attr('content');
                Swal.fire({
                            title: 'apa anda yakin?',
                            text: " Menghapus  Data berita " + nama,
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'hapus data',
                            cancelButtonText: 'batal',
                            reverseButtons: true
                        }).then((result) => {
                            if (result.value) {
                                $.ajax({
                                    url : "{{ url('/api/berita')}}" + '/' + uuid,
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
                //event btn edit klik
        edit = uuid =>{
            $.ajax({
                type: "GET",
                url: "{{ url('/api/berita')}}" + '/' + uuid,
                beforeSend: false,
                success : function(returnData) {
                    $('.modal-title').text('Edit Data');
                    $('#id').val(returnData.data.uuid);
                    $('#judul').val(returnData.data.judul);
                    var editor = new FroalaEditor('#isi', {}, function () {
                    editor.html.insert(returnData.data.isi);
                    })
                    // $('#foto').val(returnData.data.foto);
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
                serverSide: true,
                searching : true,
                paging    : true,
                ajax: {
                    "type": "GET",
                    "url": "{{route('API.berita.get')}}",
                    "dataSrc": "data",
                    "contentType": "application/json; charset=utf-8",
                    "dataType": "json",
                    "processData": true
                },
                columns: [
                    {"data": "created_at"},
                    {"data": "judul"},
                    {data: null , render : function ( data, type, row, meta ) {
                        let uuid = row.uuid;
                        let nama = row.nama;
                        return type === 'display'  ?
                        '<button onClick="edit(\''+uuid+'\')" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#editmodal"><i class="ti-pencil"></i></button> <button onClick="hapus(\'' + uuid + '\',\'' + nama + '\')" class="btn btn-sm btn-outline-danger" > <i class="ti-trash"></i></button>':
                    data;
                    }}
                ]
            });
            //event form submit        
            $("form").submit(function (e) {
                e.preventDefault()
                let form = $('#modal-body form');
                if($('.modal-title').text() == 'Edit Data'){
                    let url = '{{route("API.berita.update", '')}}'
                    let id = $('#id').val();
                    $.ajax({
                        url: url+'/'+id,
                        type: "post",
                        data: new FormData(this),
                        contentType: false,
                        cache: false,
                        processData: false,
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
                        url: "{{Route('API.berita.create')}}",
                        type: "post",
                        data: new FormData(this),
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function (response) {
                            form.trigger('reset');
                            $('#mediumModal').modal('hide');
                            $('#datatable').DataTable().ajax.reload();
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Data Berhasil Disimpan',
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