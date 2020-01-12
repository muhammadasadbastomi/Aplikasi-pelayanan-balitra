
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
                            <form action="">
                            <input type="text" name="">
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
                                        <th>kode Jenis</th>
                                        <th>Jenis</th>
                                        <th>action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>kode Jenis</th>
                                        <th>Jenis</th>
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
                    url: "{{ url('/api/jenis')}}",
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
            url:"{{ url('/api/pelayanan')}}" + '/' + uuid,
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
    });

       //event form submit 
       $("form").submit(function (e) {
                    e.preventDefault()
                    let form = $('#modal-body form');
                        let url = '{{route("API.permohonan.create")}}'
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
    </script>
    
@endsection
