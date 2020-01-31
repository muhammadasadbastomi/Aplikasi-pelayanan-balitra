<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body {}
        table {
            border-collapse: collapse;
            width: 100%;
        }
        
        table,
        th,
        td {
        }
        th {
            background-color: darkslategray;
            text-align: center;
            color: aliceblue;
        }
        td {}
        br {
            margin-bottom: 5px !important;
        }
        .judul {
            text-align: center;
        }
        .header {
            margin-bottom: 0px;
            text-align: center;
            height: 150px;
            padding: 0px;
        }
        .pemko {
            width: 100px;
        }
        .logo {
            float: left;
            margin-right: 0px;
            width: 15%;
            padding: 0px;
            text-align: right;
        }
        .headtext {
            float: right;
            margin-left: 0px;
            width: 75%;
            padding-left: 0px;
            padding-right: 10%;
        }
        hr {
            margin-top: 10%;
            height: 3px;
            background-color: black;
        }
        .ttd {
            margin-left: 70%;
            text-align: center;
            text-transform: uppercase;
        }
        .text-center{
            text-align:center;
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="logo">
            <img class="pemko" src="img/logo-balitra.png">
        </div>
        <div class="headtext">
            <h2 style="margin:0px;">BALITRA BANJARBARU</h2>
            <p style="margin:0px;">Alamat : Guntung Payung, Landasan Ulin, Guntung Payung, Banjar Baru, Kota Banjar Baru, Kalimantan Selatan 70714</p>
        </div>
        <hr>
    </div>

    <div class="container">
        <div class="isi">
            <h2 style="text-align:center;">NOTA PEMBAYARAN</h2>
            <table class="table table-bordered table-hover text-center">
               <tr>
               <table class="table table-hover table-bordered">
                                <tr>
                                    <td width="250">Permohonan</td>
                                    <td>: {{$permohonan->user->name}}</td>
                                </tr>
                                <tr>
                                    <td>jenis Pelayanan</td>
                                    <td>: {{$permohonan->jenispelayanan->jenis}}</td>
                                </tr>
                                <tr>
                                    <td width="250">Analisis</td>
                                    <td style=""> :
                                    @foreach($permohonan->detail_permohonan as $a)
                                     {{$a->pelayanan->name}} - Rp.{{$a->pelayanan->price}}
                                    @endforeach                                    
                                    </td>
                                </tr>
                                <tr>
                                    <td>Biaya</td>
                                    <td>:Rp. {{$permohonan->biaya}}
                                    </td>
                                        
                                </tr>
                                <tr>
                                    <td>Tanggal Antar Barang</td>
                                    <td>: @foreach($permohonan->inbox as $r)
                                        {{$r->tgl_antar}}
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <td>Estimasi</td>
                                    <td>:{{$permohonan->pengujian->estimasi}} Hari</td>
                                </tr>                                
                                <tr>
                                    <td>Keterangan Uji</td>
                                    @php 
                                    $status = $permohonan->pengujian->status;
                                    @endphp
                                    @if($status == 0)
                                    <td>: <label class="btn btn-sm btn-warning">Pending</label></td>
                                    @elseif($status == 1)
                                    <td>: <label class="btn btn-sm btn-primary">Dalam Proses</label></td>
                                    @else
                                    <td>: <label class="btn btn-sm btn-success">Selesai</label></td>
                                    @endif
                                </tr>
                                <tr>
                                    <td>Metode Pembayaran</td>
                                    @php 
                                    $status = $permohonan->pengujian->metode_pembayaran;
                                    @endphp
                                    @if($status == 0)
                                    <td>: <label class="btn btn-sm btn-warning">belum dibayar</label></td>
                                    @elseif($status == 1)
                                    status<td>: <label class="btn btn-sm btn-primary">Cash</label></td>
                                    @else
                                    <td>: <label class="btn btn-sm btn-success">Transfer</label></td>
                                    @endif                                
                                    </tr>                                
                                <tr>
                                    <td>Lain-lain</td>
                                    <td>: {{$permohonan->pengujian->lainnya}}</td>
                                </tr>
                                <tr>
                                    <td>Keterangan</td>
                                    <td>: {{$permohonan->pengujian->keterangan}}</td>
                                </tr>
                              </table>
               </tr>
            </table>
            <br>
            <br>
            <div class="ttd">
                <h5>
                    <p>Banjarbaru, {{$tgl}}</p>
                </h5>
                <h5>Kepala Balitra</h5>
                <br>
                <br>
                <h5 style="text-decoration:underline;">Sri Bimo Nugroho, ST</h5>
                <h5>NIP.19810405 200612312 1 002</h5>
            </div>
        </div>
    </div>
</body>
</html>