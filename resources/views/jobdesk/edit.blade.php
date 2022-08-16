@extends('layout.master')
@section('content')

<div class="container">
    <div class="jumbotron">
    <h1 class="display-6">Edit</h1> <br>
            <form action="{{ route('jobdesk.update',$jobdesk->id) }}" method="POST">
                @csrf
                @method('PUT')
                    <div class="form-group">
                        <strong>Jobdesk :</strong>
                        <input type="text" class="form-control" id="jenis_j" name="jenis_j" placeholder="Jobdesk" autocomplete="off" value="{{$jobdesk->jenis_j}}">
                    </div>
<br>

<button type="submit" class="btn btn-primary">Simpan</button>
<a class="btn btn-danger" href="{{ route('jobdesk.index') }}">Back</a>


</form>


</div>


</div>

@endsection