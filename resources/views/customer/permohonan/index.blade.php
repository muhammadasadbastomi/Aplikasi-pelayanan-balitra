
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
                                <form action="post">
                                <input type="hidden" name="user_id" value="{{ $user_id }}">
                                <button type="submit" class="btn btn-outline-primary pull-right" style="margin-right:5px;"><i class="ti-plus"></i> cetak data</button>
                                </form>
                                <a href="{{Route('permohonanCetak')}}" class="btn btn-outline-info pull-right" style="margin-right:5px;"><i class="ti-printer"></i> cetak data</a>
                            </div>
                            <div class="card-body">
                            <table id="datatable" class="text-center table table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>permohonan </th>
                                        <th>tanggal</th>
                                        <th>Pemohon</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>permohonan </th>
                                        <th>tanggal</th>
                                        <th>Pemohon</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </tfoot>
                            </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- .animated -->
        </div><!-- .content -->
        
 </div> 
@endsection
@section('script')
<script>
        //fungsi hapus
        hapus = (uuid, name)=>{
            let csrf_token=$('meta[name="csrf_token"]').attr('content');
            Swal.fire({
                        title: 'apa anda yakin?',
                        text: " Menghapus Permohonan data " + name,
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'hapus data',
                        cancelButtonText: 'batal',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.value) {
                            $.ajax({
                                url : "{{ url('/api/permohonan')}}" + '/' + uuid,
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
            // fungsi render datatable
            $(document).ready(function() {
                $('#datatable').DataTable( {
                    responsive: true,
                    processing: true,
                    serverSide: false,
                    searching: true,
                    ajax: {
                        "type": "GET",
                        "url": "{{route('API.permohonan-customer.get')}}",
                        "dataSrc": "data",
                        "contentType": "application/json; charset=utf-8",
                        "dataType": "json",
                        "processData": true
                    },
                    columns: [
                        {data: null , render : function ( data, type, row, meta ) {
                            let jenis = row.jenispelayanan;

                            return jenis == null  ?
                            '<p> Data belum lengkap </p>':
                            jenis = row.jenispelayanan.jenis; 
                            '<p> '+ jenis +' </p>';
                        }},

                        {data: null , render : function ( data, type, row, meta ) {
                            let created_at = row.created_at;
                            let exist = row.jenispelayanan; 

                            if(exist == null){
                                return '<p> Data belum lengkap </p>';
                            }else{
                                return '<p> '+ created_at +' </p>';
                            }
                        }},
                        {data: null , render : function ( data, type, row, meta ) {
                            let user = row.user.name;
                            let exist = row.jenispelayanan; 

                            if(exist == null){
                                return '<p> Data belum lengkap </p>';
                            }else{
                                return '<p> '+ user +' </p>';
                            }
                        }},
                        {data: null , render : function ( data, type, row, meta ) {
                            let status = row.status;
                            let exist = row.jenispelayanan;
                            
                            if(exist == null){
                                return '<p> Data belum lengkap </p>';
                            }else{
                                return status === 0  ?
                                '<a class="btn btn-warning">pending</a>':
                                '<a class="btn btn-danger text-white">Ditolak</a>';
                            }
                        }},
                        {data: null , render : function ( data, type, row, meta ) {
                            let uuid = row.uuid;
                            let relasi = row.jenispelayanan;
                            return relasi != null  ?
                            ' <button onClick="hapus(\'' + uuid + '\',\'' + name + '\')" class="btn btn-sm btn-danger" > <i class="ti-trash"></i></button>':
                            ' <a href="/permohonan/add/'+uuid +'" class="btn btn-warning"> isi detail permohonan </a>';
                        }}
                    ]
                        
                        // {data: null , render : function ( data, type, row, meta ) {
                        //     let status = row.status;

                        //     return status === 0  ?
                        //     '<a class="btn btn-warning">pending</a>':
                        //     '<a class="btn btn-danger text-white">Ditolak</a>';
                        // }},
                        // {data: null , render : function ( data, type, row, meta ) {
                        //     let uuid = row.uuid;
                        //     let relasi = row.created_at;
                        //     return relasi != null  ?
                        //     ' <button onClick="hapus(\'' + uuid + '\',\'' + name + '\')" class="btn btn-sm btn-danger" > <i class="ti-trash"></i></button>':
                        //     ' <a href="/customer/permohonan/add/'+uuid +'" class="btn btn-warning"> isi detail permohonan </a> <button onClick="hapus(\'' + uuid + '\',\'' + name + '\')" class="btn btn-sm btn-danger" > <i class="ti-trash"></i></button>';
                        // }}
                    
                });

                //event form submit 
                $("form").submit(function (e) {
                    e.preventDefault()
                    let form = $('#modal-body form');
                    if($('.modal-title').text() == 'Edit Data'){
                        let url = '{{route("API.permohonan-customer.create", '')}}'
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
                            url: "{{Route('API.permohonan-customer.create')}}",
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
