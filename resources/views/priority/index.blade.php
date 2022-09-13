@extends('layout.master')
@section('content')

<!-- sweet alert -->
@include('sweetalert::alert')

<!-- Button trigger modal -->
<div class="row" style="padding-top: 7em;">
    <div style="text-align:center;">
      <h1>Form Priority</h1>
    </div>
    <div class="col-lg-12 margin-tb">
        <div class="pull-left" style="padding-left: 2em">
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><ion-icon name="add-outline"></ion-icon></button>
        </div>
      </div>
</div>

  <!-- Modal -->
  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Tambah</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('priority.store') }}" method="post">
                @csrf

                <div class="form-group">
                    <strong>ID :</strong>
                    <input type="number" class="form-control" id="id" name="id" placeholder="ID">
                </div>

                <div class="form-group">
                    <strong>Priority :</strong>
                    <input type="text" class="form-control" id="jenis_prioritas" name="jenis_prioritas" placeholder="Priority" autocomplete="off">
                </div>

                <div class="form-group">
                    <input type="checkbox" name="aktif" id="aktif" value="1">
                    <label for="aktif">Aktif</label>
                </div>

                <div class="modal-footer">
                  <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><ion-icon name="close-circle-outline"></ion-icon>Close</button>  -->
                    <button type="submit" class="btn btn-primary"><ion-icon name="checkmark-outline"></ion-icon> Submit</button>
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>

  <div style="padding: 2em;">
<table class="table table-bordered table-striped table-hover">
    <thead>
        <tr>
            <th><b>ID</b></th>
            <th><b>Priority</b></th>
            <th><b>Aktif</b></th>
            <th class="col-2"><b>Action</b></th>
        </tr>
    </thead>
    <tbody>
        @foreach($priorities as $priority)
        <tr>
            <td>{{ $priority->id }}</td>
            <td>{{ $priority->jenis_prioritas }}</td>
            <td>{{ $priority->aktif }}</td>
            <td>
                <a class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalUpdate{{$priority->id}}"><ion-icon name="pencil-sharp"></ion-icon></a>
                <!-- <form action="{{route('priority.destroy',$priority->id)}}" method="post">                  
                    @csrf 
                    @method('DELETE')
                    <a class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalDelete{{$priority->id}}"><ion-icon name="trash-outline"></ion-icon></a>
                </form> -->

        <!-- Start Edit Model -->
  <div class="modal fade" id="modalUpdate{{$priority->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Edit</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <form action="{{ route('priority.update', $priority->id) }}" method="POST" enctype="multipart/form-data" id="editForm">
          @csrf
          @method('PUT')

            <div class="form-group">
                <strong>ID :</strong>
                <input type="number" class="form-control" id="id" name="id" placeholder="ID" value="{{$priority->id}}">
            </div>

            <div class="form-group">
                <strong>Priority :</strong>
                <input type="text" class="form-control" id="jenis_prioritas" name="jenis_prioritas" placeholder="Priority" value="{{$priority->jenis_prioritas}}">
            </div>

            <div class="form-group">
                <input type="checkbox" name="aktif" id="aktif" {{ $priority->aktif == 1 ? 'checked' : '' }}>
                <label for="aktif">Aktif</label>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
    </form>
      
    </div>
  </div>
</div>
</div>

<!-- Start Delete Modal -->
<div class="modal fade" id="modalDelete{{$priority->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Delete</h5>
        <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
      </div>
            <div class="modal-body">

            <form action="{{ route('priority.destroy', $priority->id) }}" method="POST" enctype="multipart/form-data" id="editForm">
                <p>Yakin Hapus priority {{$priority->jenis_prioritas}} ?</p>
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

    </td>
</tr>

        @endforeach
    </tbody>
</table>
</div>

@endsection