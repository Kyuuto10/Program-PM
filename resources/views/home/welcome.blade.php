@extends('layout.master')
@section('content')
<div style="padding:2em;">
 <div class="card-footer text-center">
        <!-- <div class="card-header">
          <strong class="card-title" style="text-align:center;">Halo</strong>
        </div> -->
        @auth
        <div class="card-body"  style="padding-top:5em;">
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
          <th>Tanggal</th>
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
            <td>{{ $project->tanggal }}</td>
            <td>{{ $project->nama_instansi }}</td>
            <td>{{ $project->nama_lokasi }}</td>
            <td>{{ $project->nama_teknisi }}</td>
            <td>{{ $project->produk }}</td>
            <td>{{ $project->warranty }}</td>
            <td>{{ $project->priority }}</td>
            <!-- <td>{{ $project->jobdesk }}</td>
            <td>{{ $project->deskripsi }}</td>
            <td>{{ $project->status }}</td>
            <td>{{ $project->image }}</td>
            <td>{{ $project->item }}</td>
            <td>{{ $project->tgl_pengiriman }}</td>
            <td>{{ $project->status1 }}</td>
            <td>{{ $project->tgl_kembali }}</td>
            <td>{{ $project->status2 }}</td> -->
            <td>
              <form action="{{route('project.show', $project->id)}}" method="post">
                @csrf 
                <a class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalShow{{$project->id}}">Detail</a>
              </form>

              <div class="modal fade" id="modalShow{{$project->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Show</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <form action="{{ route('project.show', $project->id) }}" method="POST" enctype="multipart/form-data" id="showForm">
                            @csrf
                                <div class="card-body">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item"><b>Tanggal :&ensp;</b>{{$project->tanggal}}</li>
                                        <li class="list-group-item"><b>Nama Instansi :&ensp;</b>{{$project->nama_instansi}}</li>
                                        <li class="list-group-item"><b>Nama Lokasi :&ensp;</b>{{$project->nama_lokasi}}</li>
                                        <li class="list-group-item"><b>Teknisi :&ensp;</b>{{$project->nama_teknisi}}</li>
                                        <li class="list-group-item"><b>Produk :&ensp;</b>{{$project->produk}}</li>
                                        <li class="list-group-item"><b>Warranty :&ensp;</b>{{$project->warranty}}</li>
                                        <li class="list-group-item"><b>Priority :&ensp;</b>{{$project->priority}}</li>
                                        <li class="list-group-item"><b>Jobdesk :&ensp;</b>{{$project->jobdesk}}</li>
                                        <li class="list-group-item"><b>Deskripsi :&ensp;</b>{{$project->deskripsi}}</li>
                                        <li class="list-group-item"><b>Status :&ensp;</b>{{$project->status}}</li>
                                        <div style="max-height:200px;">
                                        <li class="list-group-item"><b>Foto :&ensp;</b><img src="{{asset('images/'.$project->image)}}" style="width:15%; height:15%;" tooltip="{{$project->image}}"></li>
                                        </div>
                                        <li class="list-group-item"><b>Item :&ensp;</b>{{$project->item}}</li>
                                        <li class="list-group-item"><b>Tanggal Pengiriman :&ensp;</b>{{$project->tgl_pengiriman}}</li>
                                        <li class="list-group-item"><b>Status :&ensp;</b>{{$project->status1}}</li>
                                        <li class="list-group-item"><b>Tanggal Kembali :&ensp;</b>{{$project->tgl_kembali}}</li>
                                        <li class="list-group-item"><b>Status :&ensp;</b>{{$project->status2}}</li>
                                        <li class="list-group-item"><b>Komentar :&ensp;</b>{{$project->comment}}</li>
                                    </ul>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            </td>
        </tr>
            @endforeach
        </tbody>
      </table>
      </div>

  

      @endif
      @endauth


      <!-- /.card -->
      @endsection