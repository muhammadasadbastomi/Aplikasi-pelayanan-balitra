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
            <h2 style="text-align:center;">BUKTI ANTAR BARANG</h2>
            <div class="col-md-4">
        <table>
            <tr>
                <td> Pengirim</td>
                <td> : Admin</td>
            </tr>
            <tr>
            <td>Waktu</td>
            <td> : {{$inbox->created_at}}</td>
            </tr>
            <tr>
                <td>Subject</td>
                <td>: {{$inbox->subject}}</td>
            </tr>
        </table>

        <div class="col-md-8 text-right">
            <a href="{{Route('notifCetak',['id'=>$inbox->id])}}" class="text-primary" style="margin-right:5px;"> <i class="ti-printer"></i> </a>
        </div>
    </div>
    <br>
    <p style="text-align: justify;" >Permohonan pengujiian {{$inbox->permohonan->user->name}} yang diajukan pada tanggal {{$inbox->permohonan->created_at}} telah di verifikasi oleh admin dab dinyatakan @if($inbox->permohonan->id = 1) <b class="text-danger">DITERIMA</b>@else  <b class="text-danger">DITOLAK</b> @endif dengan keterangan :{{$inbox->keterangan}} </p>
    <br>
    <p>Harap dapat mengantar Sampel Uji pada, </p>
    <table>
        <tr>
        <td> Tanggal </td>
        <td> : {{ date('d-m-Y', strtotime($inbox->tgl_antar)) }} </td>
        </tr>
        <tr>
            <td>Tempat</td>
            <td>: Kantor Balitra Banjarbaru Jalan Kebun Karet Kelurahan Loktabat Utara, Banjarbaru Utara</td>
        </tr>
    </table>
    <br>
    <p>Sekian pemberitahuan ini kami beri sampaikan ,anda dapat mencetak pesan ini sebagai bukti bahwa permohonan anda telah disetujui atas perhatiannya terimakasih.</p>
</div>
        </div>
            <br>
            <br>
            <div class="ttd">
               <img  width="150" src="img/barcode.jpg" alt="">
            </div>
        </div>
    </div>
</body>
</html>
