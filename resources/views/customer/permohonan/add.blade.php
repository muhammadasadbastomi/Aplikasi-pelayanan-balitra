@extends('layouts.admin')
@section('content')
<div class="page-wrapper">
             <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Library</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
            <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Input Data Pencairan</h5>
                                <br>
                                <form id="form1" action="" method="post">
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
                                <br>
                                <br>
                                <table id="datatable" class="table table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Pelayanan</th>
                                        <th>Biaya</th>
                                        <th>action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Pelayanan</th>
                                        <th>Biaya</th>
                                        <th>action</th>
                                    </tr>
                                </tfoot>
                            </table>
                                    <div class="card-footer text-right">
                                    <form  id="form2" action="post">
                                        <input type="hidden" name="id_pencairan" value="{{$permohonan->id}}">
                                        <button type="submit" name="submit" class="btn btn-success">Selesai, buat pencairan</button>
                                    </form>
                                    </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
        let id = $('#pencairan_id').val();
                $('#datatable').DataTable( {
                    responsive: true,
                    processing: true,
                    serverSide: false,
                    searching: true,
                    ajax: {
                        "type": "GET",
                        "url": "{{ url('api/permohonan-detail-customer')}}" + '/' + id,
                        "dataSrc": "data",
                        "contentType": "application/json; charset=utf-8",
                        "dataType": "json",
                        "processData": true
                    },
                    columns: [
                        {"data": "pelayanan.biaya"},
                        {"data": "pelayanan.biaya"},
                        {data: null , render : function ( data, type, row, meta ) {
                            let uuid = row.uuid;
                            let name = row.jenis;
                            return type === 'display'  ?
                            '<button onClick="edit(\''+uuid+'\')" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#editmodal"><i class="ti-pencil"></i></button> <button onClick="hapus(\'' + uuid + '\',\'' + name + '\')" class="btn btn-sm btn-outline-danger" > <i class="ti-trash"></i></button>':
                        data;
                        }}
                    ]
                });
            });
            //event form submit            
                $("#form1").submit(function (e) {
                    e.preventDefault()
                    let form = $('#modal-body form');
                        let url = '{{route("API.permohonan-detail-customer.create")}}'
                        let id = $('#id').val();
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
            
        //event form submit            
        $("#form2").submit(function (e) {
                    e.preventDefault()
                    let form = $('#modal-body form');
                        let url = '{{route("API.permohonan-detail-customer.create")}}'
                        let id = $('#id').val();
                        $.ajax({
                            url: url,
                            type: "post",
                            data: $(this).serialize(),
                            success: function (response) {
                                window.location.replace("/pencairanIndex");
                            },
                            error:function(response){
                                console.log(response);
                            }
                        })
                } );
    </script>
@endsection