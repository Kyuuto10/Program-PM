@extends('layout.master')

@section('content')

<!-- SweetAlert -->
@include('sweetalert::alert')

<!-- Button trigger modal -->
<div class="row" style="padding-top: 7em;">
    <div style="text-align:center;">
      <h1>Form Akun</h1>
    </div>
    <div class="col-lg-12 margin-tb">
        <div class="pull-left" style="padding-left: 2em">
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><ion-icon name="add-outline"></ion-icon></button>
        </div>
      </div>
</div>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Tambah</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('user.store') }}" method="post">
                @csrf

                <div class="form-group">
                        <strong>Nama :</strong>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nama" autocomplete="off" required>
                    </div>

                    <div class="form-group">
                        <strong>Email :</strong>
                        <input type="text" class="form-control" id="email" name="email" placeholder="Email" autocomplete="off" required>
                    </div>

                    <div class="form-group">
                      <strong>Password :</strong>
                      <input type="password" class="form-control" id="password" name="password" placeholder="Password" autocomplete="off" required>
                    </div>
                                    
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="type" value="1" required>
                        <label class="form-check-label "for="inlineRadio1">Admin</label>
                        <input class="form-check-input" type="radio" name="type" value="0" required>
                        <label class="form-check-label "for="inlineRadio1">User</label>
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

<div style="padding:2em;">
<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th><b>No</b></th>
            <th><b>Nama</b></th>
            <th><b>Email</b></th>
            <th><b>Role</b></th>
            <th class="col-2"><b>Action</b></th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $i = 0;
        ?>
        @foreach($users as $user)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->type }}</td>
            <td>
                <a class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalUpdate{{$user->id}}"><ion-icon name="pencil-sharp"></ion-icon></a>

<!-- Start Edit Modal -->
<div class="modal fade" id="modalUpdate{{$user->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Edit</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
          <div class="modal-body">

            <form action="{{ route('user.update', $user->id) }}" method="POST" id="editForm">
              @csrf
              @method('PUT')

                <div class="form-group">
                    <strong>Nama :</strong>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Nama" value="{{$user->name}}">
                </div>

                <div class="form-group">
                    <strong>Email :</strong>
                    <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="{{$user->email}}">
                </div>

                <div class="form-group">
                      <strong>Password :</strong>
                      <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="{{$user->password}}">
                </div>

                <div class="form-group">
                  <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="type" value="1"
                          {{$user->type == 'admin' ? 'checked' : ''}} >
                          <label class="form-check-label "for="type">Admin</label>
                          <input class="form-check-input" type="radio" name="type" value="0"
                          {{$user->type == 'user' ? 'checked' : ''}} >
                          <label class="form-check-label "for="type">User</label>
                  </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
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
{{ $users->links() }}
</div>
@endsection