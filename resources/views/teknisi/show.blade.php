@extends('layout.master')
@section('content')


<div class="col-lg-12 margin-tb">
            <div>
                <h2> Show</h2>
            </div>
            



    <div class="card-body">
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><b>ID :&ensp;</b>{{$teknisi->code}}</li>
                <li class="list-group-item"><b>Nama Teknisi :&ensp;</b>{{$teknisi->nama_teknisi}}</li>
            </ul>
            <br>

            <a href="{{route('teknisi.index')}}" class="btn btn-primary">Back</a>
    </div>

    @endsection