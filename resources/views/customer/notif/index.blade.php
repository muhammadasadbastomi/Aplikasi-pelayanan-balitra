
@extends('layouts.customer')
@section('content')
<br>
<br>

<div class="col-md-4">
<div class="feed-box text-center">
<section class="card">
<div class="card-body">
<div class="corner-ribon blue-ribon">
<i class="fa fa-user"></i>
</div>
<a href="#">
<img class="align-self-center rounded-circle mr-3" style="width:150px; height:150px;" alt="" src="{{asset('admin/images/admin.jpg')}}">
</a>
<h2>Nama customer</h2>
<p>perusahsaan xxx</p>
</div>
</section>
</div>
</div>

<div class="col-md-8">
<aside class="profile-nav alt">
<section class="card">
<div class="card-header user-header alt bg-light">
<div class="media">
<div class="media-body">
<h3 class="text-dark display-6">Pemberitahuan</h3>
</div>
</div>
</div>
<ul class="list-group list-group-flush">
    @foreach( $inbox as $i)
    <li class="list-group-item">
        <a href="{{Route('notifDetail',['id' => $i->id ] )}}"> <i class="fa fa-envelope-o"></i> Admin  
        @if($i->status == 0)
        <span class="badge badge-success pull-right">belum dibaca</span></a><br>

        @elseif($i->status == 1)
        <span class="badge badge-secondary pull-right">sudah  dibaca</span></a><br>
        @else
        <p>tes</p>
        @endif
        <small>{{$i->created_at}}</small>
    </li>
    @endforeach
</ul>
</section>
</aside>
</div>
@endsection