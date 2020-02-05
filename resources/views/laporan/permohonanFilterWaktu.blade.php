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
            border: 1px solid #708090;
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
            <h2 style="text-align:center;">LAPORAN PERMOHONAN FILTER PERIODE</h2>
            <table class="table table-bordered table-hover text-center">
                <thead>
                    <tr>
                        <th>Jenis Pelayanan</th>
                        <th>Tanggal</th>
                        <th>Pemohon</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($permohonan as $r)
                    <tr>
                        <td>{{$r->jenispelayanan->jenis}}</td>
                        <td>{{$r->created_at}}</td>
                        <td>{{$r->user->name}}</td>
                        <td>
                            @if($r->status === 0)
                                <p style="color:red;">Pending</p>
                            @else
                                <p style="color:green;">Terverifikasi</p>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                    </tfoot>
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
