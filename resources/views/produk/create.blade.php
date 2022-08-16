@extends('layout.master')
@section('content')

<div class="container">
    <div class="jumbotron">
    <h1 class="display-6">Tambah</h1> <br>
            <form action="{{ route('produk.store') }}" method="POST">
                @csrf

                    <div class="form-group">
                        <strong>Nama Produk :</strong>
                        <input type="text" class="form-control" id="nama_produk" name="nama_produk" placeholder="Nama Produk" autocomplete="off">
                    </div>
<br>

<button type="submit" class="btn btn-primary">Simpan</button>
<a class="btn btn-danger" href="{{ route('produk.index') }}">Back</a>


</form>


</div>


</div>

@endsection