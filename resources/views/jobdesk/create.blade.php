@extends('layout.master')
@section('content')

<div class="container">
    <div class="jumbotron">
    <h1 class="display-6">Tambah</h1> <br>
            <form action="{{ route('jobdesk.store') }}" method="POST">
                @csrf

                    <div class="form-group">
                        <strong>Jobdesk :</strong>
                        <input type="text" class="form-control" id="jenis_j" name="jenis_j" placeholder="Jobdesk" autocomplete="off">
                    </div>
<br>

<button type="submit" class="btn btn-primary">Simpan</button>
<a class="btn btn-danger" href="{{ route('jobdesk.index') }}">Back</a>


</form>


</div>


</div>

@endsection