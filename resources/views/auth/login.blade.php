@extends('layouts.app')

@section('content')

@include('sweetalert::alert')

@if ($message = Session::get('message'))
    <div class="alert alert-danger">
        <p>{{ $message }}</p>
    </div>
    @endif

    <style>
        .button{
            padding: 5px 10px;
            font-size: 15px;
            cursor: pointer;
            outline: none;
            color: #000;
            background-color: #fff;
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px #d6d6d6;
        }
        .button:hover {background-color: #ededed}

        .button:active {
        background-color: #ededed;
        box-shadow: 0 2px #d6d6d6;
        transform: translateY(2px);
        }
        .card{
            border-radius: 2em;
            margin: 0 auto;
            box-shadow: 0 5 10px rgba(0,0,0,.2);
            background-color: #063970;
        }
        label b{
            color: white;
        }
    </style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-5 col-xl-5">
            <div class="">

            <center><img src="{{url('public/template/images/nts.png')}}"class="img-fluid" alt="Phone image"width="125px" style="border-radius:50%;"></center>
            <br>
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title p-3" style="text-align:center; color:white;"><b>Login</b></h2>                       
                        
                        <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="row mb-3">
                            <div class="form-outline mb-4">
                                <label><b>Username</b></label>
                                <input id="username" type="username" class="form-control @error('username') is-invalid @enderror" name="username" autocomplete="off" placeholder="Masukkan Username" value="{{old('username')}}" autofocus>
                                    @error('username')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                            </div>

                            <!-- Password input -->
                            <div class="form-outline mb-4">
                                <label><b>Password</b></label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="current-password" placeholder="Masukkan Password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <!-- <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div> -->

                        <div class="row mb-0">
                            <div class="d-grid gap-2 col-6 mx-auto">
                                <button class="button" type="submit" class="btn btn-primary">
                                   <b>{{ __('Login') }}</b>
                                </button>

                                <!-- @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif -->
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
