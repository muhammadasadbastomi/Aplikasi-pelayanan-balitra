
@extends('layouts.admin')
@section('content')
<div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Data Pengujian</h1>
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
                            <div class="form-group">
                                <select class="form-control" name="jenis_pelayanan_id" id="jenis_pelayanan_id">
                                    <option value="">--pilih pelayanan--</option>
                                </select>
                            </div>
                                <div class="form-group">
                                    <select  style="width:100%;" class="js-example-basic-multiple" name="pelayanan_id[]" id="pelayanan_id" multiple="multiple">
                                    </select>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                            <button id="btn-form" type="submit" class="btn btn-primary"><i class="ti-save"></i> Simpan</button>
                                </form>
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
                        $('#jenis_pelayanan_id').append(
                            '<option value="'+value.uuid+'">'+value.jenis+'</option>'
                        )
                    })
                }
            })
        }
        getJenis();

        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });

    $('#jenis_pelayanan_id').on('change',function(){
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
    </script>
    
@endsection
