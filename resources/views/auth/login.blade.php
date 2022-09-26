@extends('layouts.app')

@section('content')

@if ($message = Session::get('message'))
    <div class="alert alert-danger">
        <p>{{ $message }}</p>
    </div>
    @endif

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-5 col-xl-5">
            <div class="">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title p-3" style="text-align:center;">Login</h5>                       
                        <center><img src="{{url('template/images/nts.png')}}"class="img-fluid" alt="Phone image"width="125px"></center>
                        <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="row mb-3">
                            <div class="form-outline mb-4">
                                <label>Username</label>
                                <input id="username" type="username" class="form-control @error('username') is-invalid @enderror" name="username" autocomplete="off" autofocus>
                                    @error('username')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                            </div>

                            <!-- Password input -->
                            <div class="form-outline mb-4">
                                <label>Password</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="current-password">
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
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
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
