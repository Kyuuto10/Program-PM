@extends('layout.master')
@section('content')

    <!-- sweet alert -->
    @include('sweetalert::alert')

    <!-- Button trigger modal -->
<div style="padding: 6em 2em 1em;">
<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
<ion-icon name="add-outline"></ion-icon>
  </button>
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
                        <input type="text" class="form-control" id="jenis_s" name="jenis_s" placeholder="Status" autocomplete="off">
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
            <th>No</th>
            <th>Status</th>
            <th class="col-2">Action</th>
        </tr>
    </thead>
    <tbody>
       <?php $i=0; ?>
       @foreach($stattus as $status)
       <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $status->jenis_s }}</td>
        <td>
            <form action="{{route('status.destroy', $status->id)}}" method="post">
                <!-- <a href="{{route('status.edit', $status->id)}}" type="submit" class="btn btn-warning"><ion-icon name="pencil-sharp"></ion-icon></a> -->
                <a class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalUpdate{{$status->id}}"><ion-icon name="pencil-sharp"></ion-icon></a>
                @csrf 
                
                <a class="btn btn-danger" data-bs-toggle="modal" ><ion-icon name="trash-outline"></ion-icon></a>
                <!-- data-bs-target="#myModalDelete{{$status->id}}" -->
            </form>
        </td>
       </tr>

       

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
                    <input type="text" class="form-control" id="jenis_s" name="jenis_s" placeholder="Status" value="{{$status->jenis_s}}">
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
  <!-- <div class="modal fade" id="myModalDelete{{$status->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Delete</h5>
        
        </div>
          <div class="modal-body">

            <form action="{{ route('status.destroy', $status->id) }}" method="POST" enctype="multipart/form-data" id="deleteForm">
              <p>Yakin Hapus Status {{$status->jenis_s}} ?</p>
              <br>
              @csrf
              @method('DELETE')
              <button type="button"  class="btn btn-warning" data-bs-dismiss="modal" >Back</button>
              <button type="submit" class="btn btn-danger"><ion-icon name="trash-outline"></button>

            </form>

          </div>
      </div>
    </div>
  </div> -->



       @endforeach
    </tbody>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js">

$('.btn-danger').on('click', function (event) {
    event.preventDefault();
    const url = $(this).attr('href');
    swal({
        title: 'Are you sure?',
        text: 'This record and it`s details will be permanantly deleted!',
        icon: 'warning',
        buttons: ["Cancel", "Yes!"],
    }).then(function(value) {
        if (value) {
            window.location.href = url;
        }
    });
});
</script>
</table>
</div>

@endsection