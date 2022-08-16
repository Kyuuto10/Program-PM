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

    <div class="row justify-content-center">
          <div class="col-md-6">
            <form action="{{route('project.index')}}">
            <div class="input-group mb-3">
              <input type="text" class="form-control" placeholder="Search.." name="searh">
              <button class="btn btn-primary" type="button">Search</button>
            </div>
            </form>
          </div>
        </div>

<div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <a class="btn btn-success" href="{{ route('project.create') }}"> Create New Product</a>
            </div>
        </div>
    </div>
<br>
<table class="table table-bordered table-striped table-hover table-responsive">
    <thead>
        <tr>
            <th>No</th>
            <!-- <th>Tanggal</th> -->
            <th>Nama Instansi</th>
            <th>Nama Lokasi</th>
            <th>Teknisi</th>
            <th>Produk</th>
            <th>Warranty</th>
            <th>Priority</th>
            <!-- <th>Jobdesk</th>
            <th>Deskripsi</th>
            <th>Status</th>
            <th>Foto</th>
            <th>Item</th>
            <th>Tgl Pengiriman</th>
            <th>Status</th>
            <th>Tgl Kembali</th>
            <th>Status</th> -->
            <th>Action</th>
           
        </tr>
    </thead>
    <tbody>
        <?php $i=0; ?>
        @foreach($projects as $project)
        <tr>
            <td>{{ ++$i }}</td>
            <!-- <td>{{ $project->tanggal }}</td> -->
            <td>{{ $project->nama_instansi }}</td>
            <td>{{ $project->nama_lokasi }}</td>
            <td>{{ $project->nama_teknisi }}</td>
            <td>{{ $project->produk }}</td>
            <td>{{ $project->warranty }}</td>
            <td>{{ $project->priority }}</td>
            <!-- <td>{{ $project->jobdesk }}</td>
            <td>{{ $project->deskripsi }}</td>
            <td>{{ $project->status }}</td>
            <td>{{ $project->foto }}</td>
            <td>{{ $project->item }}</td>
            <td>{{ $project->tgl_pengiriman }}</td>
            <td>{{ $project->status1 }}</td>
            <td>{{ $project->tgl_kembali }}</td>
            <td>{{ $project->status2 }}</td> -->
            <td>
                <form action="{{route('project.destroy',$project->id)}}" method="post" enctype="multipart/form-data">
                    <a href="{{route('project.edit',$project->id)}}" class="btn btn-warning"><ion-icon name="pencil-sharp"></ion-icon></a>
                    <a href="{{route('project.show',$project->id)}}" class="btn btn-info"><ion-icon name="search-outline"></ion-icon></a>
                    @csrf 
                    @method('DELETE')
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>



@endsection

