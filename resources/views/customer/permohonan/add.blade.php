
@extends('layouts.customer')
@section('content')
<div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Tambah Data Permohonan</h1>
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
                            </div>
                            <div class="card-body">
                            <form action="post">
                            <input type="text" name="permohonan_id" id="permohonan_id" value="{{$permohonan->id}}">
                            <div class="form-group">
                                <select class="form-control" name="jenispelayanan_id" id="jenispelayanan_id">
                                    <option value="">--pilih pelayanan--</option>
                                </select>
                            </div>
                                <div class="form-group">
                                    <select  style="width:100%;" class="form-control" name="pelayanan_id" id="pelayanan_id" >
                                    </select>
                                </div>
                                <div class="form-group">
                                <label for="">Keterangan</label>
                                   <textarea name="keterangan" id="keterangan" class="form-control"></textarea>
                                </div>
                                <div class="text-right">
                                <button id="btn-form" type="submit" class="btn btn-primary"><i class="ti-save"></i> Tambahkan</button>
                                </form>
                                </div>
                                <br>
                                <br>
                                <table id="datatable" class="table table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Jenis</th>
                                        <th>Pelayanan</th>
                                        <th>Biaya</th>
                                        <th>action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Jenis</th>
                                        <th>Pelayanan</th>
                                        <th>Biaya</th>
                                        <th>action</th>
                                    </tr>
                                </tfoot>
                            </table>
                            </div>
                            
                            <br>
                            <br>
                            </div>                                
                        </div>
                    </div>
                </div>
            </div><!-- .animated -->
        </div><!-- .content -->
       
@endsection
@section('script')
    <script>
            getJenis = () => {
            $.ajax({
                    type: "GET",
                    url: "{{ url('/api/jenis-customer')}}",
                    beforeSend: false,
                    success : function(returnData) {
                        $.each(returnData.data, function (index, value) {
                        $('#jenispelayanan_id').append(
                            '<option value="'+value.uuid+'">'+value.jenis+'</option>'
                        )
                    })
                }
            })
        }
        getJenis();
    $('#jenispelayanan_id').on('change',function(){
        var uuid = $(this).val();
        if(uuid){
            $.ajax({
            type:"GET",
            url:"{{ url('/api/pelayanan-customer')}}" + '/' + uuid,
            success:function(returnData){
                if(returnData){
                    $("#pelayanan_id").empty();
                            $.each(returnData.data, function (index, value) {
                        $("#pelayanan_id").append('<option value="'+value.uuid+'">'+value.name+'- Rp.'+value.price+' </option>');
                    });
                }else{
                $("#kecamatan").empty();
                }
            }
            });
        }else{
            $("#kecamatan").empty();
            $("#kelurahan").empty();
        }
    }),
    // fungsi render datatable
    $(document).ready(function() {
                $('#datatable').DataTable( {
                    responsive: true,
                    processing: true,
                    serverSide: false,
                    searching: true,
                    ajax: {
                        "type": "GET",
                        "url": "{{route('API.permohonan-detail-customer.get')}}",
                        "dataSrc": "data",
                        "contentType": "application/json; charset=utf-8",
                        "dataType": "json",
                        "processData": true
                    },
                    columns: [
                        {"data": "permohonan.jenispelayanan.jenis"},
                        {"data": "pelayanan.name"},
                        {"data": "biaya"},
                        {data: null , render : function ( data, type, row, meta ) {
                            let uuid = row.uuid;
                            let name = row.jenis;
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
                        let url = '{{route("API.permohonan-detail-customer.create")}}'
                        $.ajax({
                            url: url,
                            type: "post",
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
                } );
            });
        
    </script>
    
@endsection
