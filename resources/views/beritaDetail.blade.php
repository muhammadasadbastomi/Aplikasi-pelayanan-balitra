
@extends('layouts.depan')
@section('content')
  
  <!-- Page Content -->
  <div class="container">
  <br>
  <img src="{{asset('/img/berita/'.$berita->foto)}}" alt="" style="width:100% !important; height:80% !important;">
  <br>
  <br>
  <h1 style="font-size:40px">{{$berita->judul}}</h1>
  <br>
  @php
    $isi = $berita->isi;
  @endphp
    <p style="text-align:justify">{!! $isi !!}</p>
  </div>
  <!-- /.container -->
  @endsection