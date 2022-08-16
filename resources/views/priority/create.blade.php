@extends('layout.master')
@section('content')

<div class="container">
    <div class="jumbotron">
    <h1 class="display-6">Tambah</h1> <br>
            <form action="{{ route('priority.store') }}" method="POST">
                @csrf

                    <div class="form-group">
                        <strong>Priority :</strong>
                        <input type="text" class="form-control" id="jenis_prioritas" name="jenis_prioritas" placeholder="Priority" autocomplete="off">
                    </div>
<br>

<button type="submit" class="btn btn-primary">Simpan</button>
<a class="btn btn-danger" href="{{ route('priority.index') }}">Back</a>


</form>


</div>


</div>

@endsection