@extends('layout.master')
@section('content')

@if ($message = Session::get('msg'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
@if ($message = Session::get('edit'))
        <div class="alert alert-warning">
            <p>{{ $message }}</p>
        </div>
    @endif
@if ($message = Session::get('delete'))
        <div class="alert alert-danger">
            <p>{{ $message }}</p>
        </div>
    @endif

<div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <a class="btn btn-success" href="{{ route('produk.create') }}">Tambah</a>
            </div>
        </div>
    </div>
<br>
<table class="table table-bordered table-striped table-hover">
    <thead>
        <tr>
            <th>No</th>
            <th>Produk</th>
            <th class="col-2">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $i=0; ?>
        @foreach($product as $produk)

        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $produk->nama_produk }}</td>
            <td>
                <form action="{{route('produk.destroy',$produk->id)}}" method="post">
                    <a href="{{route('produk.edit',$produk->id)}}" class="btn btn-warning"><ion-icon name="pencil-sharp"></ion-icon></a>
                    @csrf 
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin hapus Produk {{$produk->nama_produk}}?');"><ion-icon name="trash-outline"></ion-icon></button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>


@endsection