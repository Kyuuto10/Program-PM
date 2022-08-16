@extends('layout.master')
@section('content')

<div class="container">
    <div class="jumbotron">
    <h1 class="display-6">Edit Data Teknisi</h1> 
            <form action="{{ route('teknisi.update',$teknisi->id) }}" method="POST">
                @csrf
                @method('PUT')
                    <div class="form-group">
                        <strong>ID :</strong>
                        <input type="number" class="form-control" id="code" name="code" placeholder="id" autocomplete="off" value="{{$teknisi->code}}">
                    </div>

                    <div class="form-group">
                        <strong>Nama Teknisi :</strong>
                        <input type="text" class="form-control" id="nama_teknisi" name="nama_teknisi" placeholder="Nama Teknisi" autocomplete="off" value="{{$teknisi->nama_teknisi}}">
                    </div>
<br>

<button type="submit" class="btn btn-primary">Simpan</button>
<a class="btn btn-danger" href="{{ route('teknisi.index') }}">Back</a>


</form>

</div>


</div>

@endsection