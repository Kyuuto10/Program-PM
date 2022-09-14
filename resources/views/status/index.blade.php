@extends('layout.master')
@section('content')

    <!-- sweet alert -->
    @include('sweetalert::alert')

    <!-- Button trigger modal -->
<div class="row" style="padding-top: 7em;">
    <div style="text-align:center;">
      <h1>Form Status</h1>
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
            <form action="{{ route('status.store') }}" method="post">
                @csrf

                <div class="form-group">
                    <strong>Status :</strong>
                    <input type="text" class="form-control" id="nama_status" name="nama_status" placeholder="Status" autocomplete="off">
                </div>

                <div class="form-group">
                    <input type="checkbox" name="aktif" value="1">
                    <label for="">Aktif</label>
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
    <thead>
        <tr>
            <th><b>No</b></th>
            <th><b>Status</b></th>
            <th><b>Aktif</b></th>
            <th class="col-2"><b>Action</b></th>
        </tr>
    </thead>
    <tbody>
       <?php $i=0; ?>
       @foreach($stattus as $status)
       <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $status->nama_status }}</td>
        <td>{{ $status->aktif }}</td>
        <td>
            <a class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalUpdate{{$status->id}}"><ion-icon name="pencil-sharp"></ion-icon></a>
            <!-- <form action="{{route('status.destroy', $status->id)}}" method="post">                               
                @csrf 
                
                <a class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#myModalDelete{{$status->id}}"><ion-icon name="trash-outline"></ion-icon></a>
                
            </form> -->
       

       

        <!-- Start Edit Model -->
  <div class="modal fade" id="modalUpdate{{$status->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Edit</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
          <div class="modal-body">

            <form action="{{ route('status.update', $status->id) }}" method="POST" enctype="multipart/form-data" id="editForm">
              @csrf
              @method('PUT')

                <div class="form-group">
                    <strong>Status :</strong>
                    <input type="text" class="form-control" id="nama_status" name="nama_status" placeholder="Status" value="{{$status->nama_status}}">
                </div>

                <div class="form-group">
                    <input type="checkbox" name="aktif" {{$status->aktif == 1 ? 'checked' : ''}}>
                    <label for="">Aktif</label>
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
  <div class="modal fade" id="myModalDelete{{$status->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Delete</h5>
        
        </div>
          <div class="modal-body">

            <form action="{{ route('status.destroy', $status->id) }}" method="POST" enctype="multipart/form-data" id="deleteForm">
              <p>Yakin Hapus Status {{$status->nama_status}} ?</p>
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