@extends('layout.master')
@section('content')

<div class="container">
    <div class="jumbotron">
    <h1 class="display-6">Tambah</h1> <br>
            <form action="{{ route('status.store') }}" method="POST">
                @csrf

                    <div class="form-group">
                        <strong>Status :</strong>
                        <input type="text" class="form-control" id="jenis_s" name="jenis_s" placeholder="Status" autocomplete="off">
                    </div>
<br>

<button type="submit" class="btn btn-primary">Simpan</button>
<a class="btn btn-danger" href="{{ route('status.index') }}">Back</a>


</form>


</div>


</div>

@endsection