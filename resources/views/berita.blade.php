
@extends('layouts.depan')
@section('content')
  <header>
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner" role="listbox">
        <!-- Slide One - Set the background image for this slide in the line below -->
        <div class="carousel-item active" style="background-image: url('/depan/img/1.jpg')">
          <div class="carousel-caption d-none d-md-block">
            <h3>First Slide</h3>
            <p>This is a description for the first slide.</p>
          </div>
        </div>
        <!-- Slide Two - Set the background image for this slide in the line below -->
        <div class="carousel-item" style="background-image: url('/depan/img/2.jpg')">
          <div class="carousel-caption d-none d-md-block">
            <h3>Second Slide</h3>
            <p>This is a description for the second slide.</p>
          </div>
        </div>
        <!-- Slide Three - Set the background image for this slide in the line below -->
        <div class="carousel-item" style="background-image: url('/depan/img/3.jpg')">
          <div class="carousel-caption d-none d-md-block">
            <h3>Third Slide</h3>
            <p>This is a description for the third slide.</p>
          </div>
        </div>
      </div>
      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </header>
  
  <!-- Page Content -->
  <div class="container">
  <br>
  <br>
    <!-- Portfolio Section -->
    <h2 class="text-center">Berita</h2>
  <br>
    <div class="row">
    @if($berita != null)
      @foreach($berita as $b)
        <div class="col-lg-4 col-sm-6 portfolio-item">
          <div class="card h-100">
            <a href="#"><img height="200" class="card-img-top" src="{{asset('/img/berita/'.$b->foto)}}" alt=""></a>
            <div class="card-body">
              <h5 class="text-center card-title">
                <p>{{$b->judul}}</p>
              </h4>
              <a href="{{Route('beritaDetail',$b->uuid)}}" class="btn btn-block btn-primary">Baca</a>
            </div>
          </div>
        </div>
      @endforeach
    @endif
    </div>
    <!-- /.row -->
  <br>
  <br>
    <hr>


  </div>
  <!-- /.container -->
  @endsection