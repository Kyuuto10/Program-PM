@extends('layout.master')
@section('content')
 <div class="card text-center">
        <div class="card-header">
          <!-- <strong class="card-title" style="text-align:center;">Halo</strong> -->

          <div class="card-tools">
          </div>
        </div>
        @auth
        <div class="card-body">
         Halo, Selamat Datang {{Auth::user()->name}}
        </div>
        @else
        <div class="card-body">
          Halo, Selamat Datang 
        </div>
        @endauth
         <!-- /.card-body -->

        <!-- /.card-footer -->
      </div> 
      <br>
@auth
      @if(Auth::user()->type == 'user')
      <table class="table table-bordered table-striped table-responsive">
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
              <form action="{{route('project.show', $project->id)}}" method="post">
                @csrf 
                <a class="btn btn-info" href="{{route('project.show', $project->id)}}">Detail</a>
              </form>
            </td>
        </tr>
            @endforeach
        </tbody>
      </table>

      @endif
      @endauth


      <!-- /.card -->
      @endsection