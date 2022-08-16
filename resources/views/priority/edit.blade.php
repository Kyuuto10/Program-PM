@extends('layout.master')
@section('content')

<div class="container">
    <div class="jumbotron">
    <h1 class="display-6">Edit</h1> <br>
            <form action="{{ route('priority.update',$prioritas->id) }}" method="POST">
                @csrf
                @method('PUT')
                    <div class="form-group">
                        <strong>Priority :</strong>
                        <input type="text" class="form-control" id="jenis_prioritas" name="jenis_prioritas" placeholder="Prioritas" autocomplete="off" value="{{$prioritas->jenis_prioritas}}">
                    </div>
<br>

<button type="submit" class="btn btn-primary">Simpan</button>
<a class="btn btn-danger" href="{{ route('priority.index') }}">Back</a>


</form>


</div>


</div>

@endsection