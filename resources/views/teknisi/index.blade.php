@extends('layout.master')

@section('content')

<!-- sweet alert -->
@include('sweetalert::alert')

<br>
<div class="row" style="padding-top: 6em;">
    <div style="text-align:center;">
      <h1>Form Teknisi</h1>
    </div>
    <div class="col-lg-12 margin-tb">
        <div class="pull-left" style="padding-left: 2em">
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Tambah Data</button>
        </div>
      </div>
</div>

  <!-- Modal -->
  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Tambah Data</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('teknisi.store') }}" method="post">
                @csrf

                <div class="form-group">
                    <strong>ID</strong>
                    <input type="text" class="form-control" id="id" name="id" placeholder="ID" autocomplete="off" required>
                </div>

                <div class="form-group">
                    <strong>Nama Teknisi</strong>
                    <input type="text" class="form-control" id="nama_teknisi" name="nama_teknisi" placeholder="Nama Teknisi" autocomplete="off" required>
                </div>

                <div class="form-group">
                    <input type="checkbox" name="aktif" id="aktif" value="1">
                    <label for="aktif">Aktif</label>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><ion-icon name="checkmark-outline"></ion-icon> Submit</button>
                  </div>
            </form>
        </div>
      </div>
    </div>
  </div>

  <div style="padding: 2em;">
<table class="table table-bordered table-striped table-hover">
    <thead style="text-align:center;">
        <tr>
            <th><b>ID</b></th>
            <th><b>Teknisi</b></th>
            <th><b>Aktif</b></th>
            <th><b>Aksi</b></th>
        </tr>
    </thead>
    <tbody>
        @forelse($teknisis as $teknisi)
        <tr>
            <td style="text-align:center;">{{ $teknisi->id }}</td>
            <td>{{ $teknisi->nama_teknisi }}</td>
            <td style="text-align:center;"><input type="checkbox" name="aktif" {{$teknisi->aktif == 1 ? 'checked' : ''}} disabled></td>
            <td style="text-align:center;">
                <a class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalUpdate{{$teknisi->id}}"><ion-icon name="pencil-sharp"></ion-icon></a>
            </td>

                <!-- Start Edit Model -->
                <div class="modal fade" id="modalUpdate{{$teknisi->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Edit Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                        <div class="modal-body">

                        <form action="{{ route('teknisi.update', $teknisi->id) }}" method="POST" enctype="multipart/form-data" id="editForm">
                          @csrf
                          @method('PUT')
                                <div class="form-group">
                                    <strong>Nama Teknisi</strong>
                                    <input type="text" class="form-control" id="nama_teknisi" name="nama_teknisi" placeholder="Nama Teknisi" value="{{$teknisi->nama_teknisi}}">
                                </div>

                                <div class="form-group">
                                    <input type="checkbox" name="aktif" id="aktif" {{$teknisi->aktif == 1 ? 'checked' : ''}}>
                                    <label for="aktif">Aktif</label>
                                </div>

                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary"><ion-icon name="checkmark-outline"></ion-icon> Submit</button>
                                </div>
                          </form>
                      
                            </div>
                        </div>
                    </div>
                </div>

        </tr>
        @empty
        <tr>
          <td colspan="12" style="text-align:center;">Tidak ada data</td>
        </tr>

        @endforelse
    </tbody>
</table>
</div>

@endsection