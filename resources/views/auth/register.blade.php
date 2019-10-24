@extends('layouts.loginRegister')

@section('content')  

    <div class="login-content">
                <div class="login-form">
                <img width="200" style="margin-left:28%;" src="{{asset('img/logo-balitra.png')}}" alt="Logo">
                <hr>
                <br>
                <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" >{{ __('Name') }}</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="form-group row">
                            <label for="email" >{{ __('E-Mail Address') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="form-group row">
                            <label for="password" >{{ __('Password') }}</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" >{{ __('Confirm Password') }}</label>

                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>

                        <div class="form-group row mb-0">
                        <div class="col-md-6">
                        <a href="/" class="btn btn-danger">kembali</a>
                        </div>
                        <div class="col-md-6">
                             <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                             </button>
                        </div>
                        </div>
                        <br>
                        <div class="register-link m-t-15 text-center">
                                    <p>sudah punya akun ? <a href="{{route('register')}}"> Silahkan Login</a></p>
                                </div>
                </div>
            </div>
@endsection
