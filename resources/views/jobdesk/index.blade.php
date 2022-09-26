@extends('layout.master')

@section('content')

<!-- sweet alert -->
@include('sweetalert::alert')

<br>
<div class="row" style="padding-top: 6em;">
    <div style="text-align:center;">
      <h1>Form Jobdesk</h1>
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
            <form action="{{ route('jobdesk.store') }}" method="post">
                @csrf

                <div class="form-group">
                    <strong>Jobdesk</strong>
                    <input type="text" class="form-control" id="nama_jobdesk" name="nama_jobdesk" placeholder="Jobdesk" autocomplete="off" required>
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
            <th><b>No</b></th>
            <th><b>Jobdesk</b></th>
            <th><b>Aktif</b></th>
            <th><b>Aksi</b></th>
        </tr>
    </thead>
    <tbody>
        <?php $i=0; ?>
        @forelse($jobdesks as $jobdesk)
        <tr>
            <td style="text-align:center;">{{ ++$i }}</td>
            <td>{{ $jobdesk->nama_jobdesk }}</td>
            <td style="text-align:center;">{{ $jobdesk->aktif }}</td>
            <td style="text-align:center;">
                <a class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalUpdate{{$jobdesk->id}}"><ion-icon name="pencil-sharp"></ion-icon></a>
                <!-- <form action="{{route('jobdesk.destroy',$jobdesk->id)}}" method="post">
                    @csrf 
                    @method('DELETE')
                    <a class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalDelete{{$jobdesk->id}}"><ion-icon name="trash-outline"></ion-icon></a>
                </form> -->
            </td>

<!-- Start Edit Model -->
<div class="modal fade" id="modalUpdate{{$jobdesk->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Edit Data</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <form action="{{ route('jobdesk.update', $jobdesk->id) }}" method="POST" enctype="multipart/form-data" id="editForm">
          @csrf
          @method('PUT')

            <div class="form-group">
                <strong>Jobdesk</strong>
                <input type="text" class="form-control" id="nama_jobdesk" name="nama_jobdesk" placeholder="jobdesk" value="{{$jobdesk->nama_jobdesk}}">
            </div>

            <div class="form-group">
                <input type="checkbox" name="aktif" id="aktif" {{ $jobdesk->aktif == 1 ? 'checked' : '' }}>
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

<!-- Start Delete Modal -->
<div class="modal fade" id="modalDelete{{$jobdesk->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Delete</h5>
        <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
      </div>
            <div class="modal-body">

            <form action="{{ route('jobdesk.destroy', $jobdesk->id) }}" method="POST" enctype="multipart/form-data" id="editForm">
                <p>Yakin hapus Jobdesk {{$jobdesk->nama_jobdesk}} ?</p>
                <br>
                @csrf
                @method('DELETE')
                <button type="button"  class="btn btn-warning" data-bs-dismiss="modal" >Back</button>
                <button type="submit" class="btn btn-danger"><ion-icon name="trash-outline"></button>

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