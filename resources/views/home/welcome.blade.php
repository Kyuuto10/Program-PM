@extends('layout.master')
@section('content')
<div class="row">
    <div class="col-lg-12" style="text-align:center; padding-top:280px;">
        @auth
        <h3><b>Selamat Datang {{Auth::user()->name}}</b></h3>
        @else
        <h3><b>Selamat Datang</b></h3>
        @endauth
    </div> 
    <br>
</div>
@endsection