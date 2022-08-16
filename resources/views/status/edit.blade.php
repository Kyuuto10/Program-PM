@extends('layout.master')
@section('content')

<div class="container">
    <div class="jumbotron">
    <h1 class="display-6">Edit</h1> <br>
            <form action="{{ route('status.update',$status->id) }}" method="POST">
                @csrf
                @method('PUT')
                    <div class="form-group">
                        <strong>Status :</strong>
                        <input type="text" class="form-control" id="jenis_s" name="jenis_s" placeholder="Nama Teknisi" autocomplete="off" value="{{$status->jenis_s}}">
                    </div>
<br>

<button type="submit" class="btn btn-primary">Simpan</button>
<a class="btn btn-danger" href="{{ route('status.index') }}">Back</a>


</form>


</div>


</div>

@endsection