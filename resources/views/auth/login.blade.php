@extends('layouts.loginRegister')

@section('content')  

    <div class="login-content">
                <div class="login-form">
                <img width="200" style="margin-left:28%;" src="{{asset('img/logo-balitra.png')}}" alt="Logo">
                <hr>
                <br>
                <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email">{{ __('E-Mail Address') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="form-group row">
                            <label for="password" >{{ __('Password') }}</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="form-group row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                            </div>
                        </div>

                        <div class="form-group row mb-0">  
                        <div class="col-md-6">
                        <a href="/" class="btn btn-danger"> kembali</a>
                        </div>
                        <div class="col-md-6">
                        <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>
                        </div>
                        </div>
                        <br>
                        <div class="register-link m-t-15 text-center">
                                    <p>Belum punya akun ? <a href="{{route('register')}}"> Daftar Sekarang</a></p>
                                </div>
                        </div>
                    </form>
                </div>
            </div>
@endsection
