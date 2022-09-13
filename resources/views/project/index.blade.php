@extends('layout.master')

@section('content')

<!-- sweet alert -->
@include('sweetalert::alert')

<br>
<div class="row" style="padding-top: 6em;">
    <div class="" style="text-align:center;">
        <h1>Form Data</h1>
    </div>
    @if(Auth::user()->type == 'admin')
    <form action="GET">
    <div class="form-group row" style="padding-left:2em;">
        <label for="" class="col-sm-2 col-form-label"></label>
        <div class="col-sm-8">
            <input type="text" name="search" id="search" class="typeahead form-control" placeholder="Search..." autofocus="true" value="{{ $search }}">
        </div>
    </div>
</form>
    <div class="col-lg-12 margin-tb">
        <div class="pull-left" style="padding-left: 2em;">            
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Create Data</button>
            <a class="btn btn-warning" href="{{ url('project/export') }}">Export to Excel</a>
        </div>
    </div>
</div>

  <!-- Modal -->
  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Tambah</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('project.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-4"><div class="form-group">
                        <strong>Nama Instansi :</strong>
                        <input type="text" class="form-control" id="nama_instansi" name="nama_instansi" placeholder="Nama Instansi" autocomplete="off" value="{{old('nama_instansi')}}" required>
                    </div>
                </div>
                    <div class="col-4"><div class="form-group">
                        <strong>Nama Lokasi :</strong>
                        <input type="text" class="form-control" id="nama_lokasi" name="nama_lokasi" placeholder="Nama Lokasi" autocomplete="off" value="{{old('nama_lokasi')}}"  required>
                    </div>
                </div>

                <div class="col-4">
                    <div class="form-group">
                       <strong>Teknisi</strong>
                        <select class="form-select" name="nama_teknisi" id="nama_teknisi" value="{{old('nama_teknisi')}}"  required>    
                                <option disabled selected option>--Pilih--</option>
                            @foreach($teknisis as $teknisi)
                                <option value="{{$teknisi->nama_teknisi}}">{{$teknisi->id}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                
                <div class="col-4">
                    <div class="form-group">
                        <strong>Produk</strong>
                        <select class="form-select" name="produk" id="produk" value="{{old('produk')}}" required> 
                                <option disabled selected option>--Pilih--</option>
                            @foreach($product as $produk)
                                <option value="{{$produk->nama_produk}}">{{$produk->nama_produk}}</option>
                            @endforeach
                        </select>
                        </div>
                </div>

                <div class="col-2">
                    <div class="form-group">
                            <strong>Warranty</strong>
                            <select class="form-select" name="warranty" id="warranty" value="{{old('warranty')}}"  required>
                                <option disabled selected option>--Pilih--</option>
                                <option value="Garansi">Garansi</option>
                                <option value="Non - Garansi">Non - Garansi</option>
                            </select>
                        </div>
                </div>

                <div class="col-2">
                    <div class="form-group">
                            <strong>Priority</strong>
                            <select class="form-select" name="priority" id="priority" value="{{old('priority')}}"  required>
                                <option disabled selected option>--Pilih--</option>
                            @foreach($priorities as $priority)
                                <option value="{{$priority->jenis_prioritas}}">{{$priority->jenis_prioritas}}</option>
                            @endforeach
                            </select>
                        </div>
                </div>

                <div class="col-4">
                    <div class="form-group">
                            <strong>Jobdesk</strong>
                            <select class="form-select" name="jobdesk" id="jobdesk" value="{{old('jobdesk')}}"  required> 
                                <option disabled selected option>--Pilih--</option>
                            @foreach($jobdesks as $jobdesk)    
                                <option value="{{$jobdesk->jenis_j}}">{{$jobdesk->jenis_j}}</option>
                            @endforeach
                            </select>
                        </div>
                </div>

                <div class="col-8">
                    <div class="form-group">
                            <strong>Deskripsi :</strong>
                            <textarea class="form-control" name="deskripsi" id="deskripsi" cols="30" rows="10" value="{{old('deskripi')}}" placeholder="Deskripsi" required>{{old('deskripi')}}</textarea>
                        </div>
                </div>

                <div class="col-4">
                    <div class="form-group">
                            <strong>Status</strong>
                            <select class="form-select" name="status" id="status" value="{{old('status')}}" required>
                                <option disabled selected option>--Pilih--</option>
                            @foreach($stattus as $status)
                                <option value="{{$status->jenis_s}}">{{$status->jenis_s}}</option>
                            @endforeach
                            </select>
                        </div>
                </div>

                
                <div class="col-8">
                    <div class="form-group">
                        <div class="user-image mb-3 text-center">
                            <div class="imgPreview">
                        </div> 
                            <strong>Foto :</strong>
                                <input type="file" class="form-control  @error('image') is-invalid @enderror" id="image" name="image" multiple value="{{old('image')}}" accept="image/*">
                        </div>
                            @error('image')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                    </div>
                </div>

                <div class="col-4">
                    <div class="form-group">
                            <strong>Item :</strong>
                            <input type="text" class="form-control" id="item" name="item" placeholder="Nama Item" value="{{old('item')}}" required>
                    </div>
                </div>

                <div class="col-3">
                    <div class="form-group">
                            <strong>Tanggal Pengiriman :</strong>
                            <input type="date" class="form-control" id="tgl_pengiriman" name="tgl_pengiriman" value="{{old('tgl_pengiriman')}}">
                        </div> 
                </div>

                <div class="col-3">
                    <div class="form-group">
                            <strong>Status</strong>
                            <select class="form-select" name="status1" id="status1" value="{{old('status1')}}">
                                <option disabled selected option>--Pilih--</option>
                                <option value="Sudah Sampai">Sudah Sampai</option>
                                <option value="Belum Sampai">Belum Sampai</option>
                            </select>
                        </div>
                </div>

                <div class="col-3">
                    <div class="form-group">
                            <strong>Tanggal Kembali :</strong>
                            <input type="date" class="form-control @error('tgl_kembali') is-invalid @enderror" id="tgl_kembali" name="tgl_kembali" value="{{old('tgl_kembali')}}">
                            @error('tgl_kembali')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                </div>

                <div class="col-3">
                    <div class="form-group">
                            <strong>Status</strong>
                            <select class="form-select" name="status2" id="status2" value="{{old('status2')}}">
                                <option disabled selected option>--Pilih--</option>
                                <option value="Sudah Sampai">Sudah Sampai</option>
                                <option value="Belum Sampai">Belum Sampai</option>
                            </select>
                        </div> 
                </div>
                <div class="col-4">
                    <div class="form-group">
                            <strong>Comment <i style="opacity:0.5;">(Opsional)&ensp;</i>:</strong>
                            <textarea class="form-control" name="comment" id="comment" cols="10" rows="5" value="{{old('comment')}}" placeholder="Komentar">{{old('comment')}}</textarea>
                        </div>
                </div>
            </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><ion-icon name="checkmark-outline"></ion-icon> Submit</button>
                  </div>
            </form>
        </div>
      </div>
    </div>
  </div>

@endif

<div class="" style="padding:2em">
<table class="table table-bordered table-striped table-hover table-responsive data-table">
    <thead>
        <tr>
            <th><b>No</b></th>
            <th><b>@sortablelink('tanggal','Tanggal')</b></th>
            <th><b>@sortablelink('nama_instansi','Nama Instansi')</b></th>
            <th><b>@sortablelink('nama_lokasi','Nama Lokasi')</b></th>
            <th><b>@sortablelink('nama_teknisi','Teknisi')</b></th>
            <th><b>Produk</b></th>
            <th><b>Warranty</b></th>
            <!-- <th>Priority</th>
            <th>Jobdesk</th>
            <th>Deskripsi</th>
            <th>Status</th>
            <th>Foto</th>
            <th>Item</th>
            <th>Tgl Pengiriman</th>
            <th>Status</th>
            <th>Tgl Kembali</th>
            <th>Status</th>
            <th>Comment</th>
            <th>ID User</th>
            <th>Date Modified</th> -->
            <th>Action</th>            
           
        </tr>
    </thead>
    <tbody>
        <?php 
        $i= 1 + (($projects->currentPage()-1) * $projects->perPage())
         ?>
        @foreach($projects as $project)
        <tr>
            <td>{{ $i++ }}</td>
            <td>{{ $project->tanggal }}</td>
            <td>{{ $project->nama_instansi }}</td>
            <td>{{ $project->nama_lokasi }}</td>
            <td>{{ $project->nama_teknisi }}</td>
            <td>{{ $project->produk }}</td>
            <td>{{ $project->warranty }}</td>
            <!-- <td>{{ $project->priority }}</td>
            <td>{{ $project->jobdesk }}</td>
            <td>{{ $project->deskripsi }}</td>
            <td>{{ $project->status }}</td> 
            <td>{{ $project->image }}</td>
            <td>{{ $project->item }}</td>
            <td>{{ $project->tgl_pengiriman }}</td>
            <td>{{ $project->status1 }}</td>
            <td>{{ $project->tgl_kembali }}</td>
            <td>{{ $project->status2 }}</td>
            <td>{{ $project->comment }}</td>
            <td>{{ $project->id_user }}</td>
            <td>{{ $project->date_modified }}</td> -->
            <td>
            <a class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalShow{{$project->id}}"><ion-icon name="eye-outline"></ion-icon></a> 
                @if(Auth::user()->type == 'admin')
                <form action="{{route('project.destroy',$project->id)}}" method="post" enctype="multipart/form-data">
                <a class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalUpdate{{$project->id}}"><ion-icon name="pencil-sharp"></ion-icon></a>
                    <!-- <a href="{{route('project.show',$project->id)}}" class="btn btn-info"><ion-icon name="search-outline"></ion-icon></a> -->                    
                    @csrf 
                    @method('DELETE')
                </form>

        <!-- Start Edit Model -->
    <div class="modal fade" id="modalUpdate{{$project->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Edit Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form action="{{ route('project.update', $project->id) }}" method="POST" enctype="multipart/form-data" id="editForm">
                    @csrf
                    @method('PUT')

                    <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <strong>Nama Instansi :</strong>
                                    <input type="text" class="form-control" id="nama_instansi" name="nama_instansi" placeholder="Nama Instansi" autocomplete="off" value="{{$project->nama_instansi}}" required >
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <strong>Nama Lokasi :</strong>
                                    <input type="text" class="form-control" id="nama_lokasi" name="nama_lokasi" placeholder="Nama Lokasi" autocomplete="off" value="{{$project->nama_lokasi}}" required >
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                <strong>Teknisi</strong>
                                    <select class="form-select" name="nama_teknisi" id="nama_teknisi" value="{{$project->nama_teknisi}}" required >    
                                            <option disabled selected option>{{$project->nama_teknisi}}</option>
                                        @foreach($teknisis as $teknisi)
                                            <option value="{{$teknisi->nama_teknisi}}">{{$teknisi->nama_teknisi}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-4">
                                <div class="form-group">
                                    <strong>Produk</strong>
                                    <select class="form-select" name="produk" id="produk" value="{{$project->produk}}" required > 
                                            <option disabled selected option>{{$project->produk}}</option>
                                        @foreach($product as $produk)
                                            <option value="{{$produk->nama_produk}}">{{$produk->nama_produk}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-2">
                                <div class="form-group">
                                    <strong>Warranty</strong>
                                    <select class="form-select" name="warranty" id="warranty" value="{{$project->warranty}}" required >
                                            <option disabled selected option>{{$project->warranty}}</option>
                                            <option value="Garansi">Garansi</option>
                                            <option value="Non - Garansi">Non - Garansi</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-2">
                                <div class="form-group">
                                        <strong>Priority</strong>
                                        <select class="form-select" name="priority" id="priority" value="{{$project->priority}}" required >
                                            <option disabled selected option>{{$project->priority}}</option>
                                        @foreach($priorities as $priority)
                                            <option value="{{$priority->jenis_prioritas}}">{{$priority->jenis_prioritas}}</option>
                                        @endforeach
                                        </select>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                        <strong>Jobdesk</strong>
                                        <select class="form-select" name="jobdesk" id="jobdesk" value="{{$project->jobdesk}}" required > 
                                            <option disabled selected option>{{$project->jobdesk}}</option>
                                        @foreach($jobdesks as $jobdesk)    
                                            <option value="{{$jobdesk->jenis_j}}">{{$jobdesk->jenis_j}}</option>
                                        @endforeach
                                        </select>
                                </div>
                            </div>

                            <div class="col-8">
                                <div class="form-group">
                                        <strong>Deskripsi :</strong>
                                        <textarea class="form-control" name="deskripsi" id="deskripsi" cols="30" rows="10" value="{{$project->deskripsi}}" placeholder="Deskripsi" required>{{$project->deskripsi}}</textarea>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                        <strong>Status</strong>
                                        <select class="form-select" name="status" id="status" value="{{$project->status}}" required>
                                            <option disabled selected option>{{$project->status}}</option>
                                        @foreach($stattus as $status)
                                            <option value="{{$status->jenis_s}}">{{$status->jenis_s}}</option>
                                        @endforeach
                                        </select>
                                </div>
                            </div>

                            <div class="col-8">
                                <div class="form-group">
                                    <div class="user-image mb-3 text-center col-8" style="max-heigth:200%;">
                                        <div class="imgPreview"></div>
                                        @if($project->image)
                                        <img src="{{asset('/images/'.$project->image)}}" class="img-thumbnail">
                                        @else
                                        <span class="badge badge-danger">Belum ada Foto</span>
                                        @endif
                                    </div>
                                  
                                        <strong>Foto :</strong>                                    
                                        <input type="file" class="custom-file-input  @error('image') is-invalid @enderror" id="image" name="image" multiple="multiple" value="{{$project->image}}" accept="images/*">
                                        @error('image')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @enderror
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                        <strong>Item :</strong>
                                        <input type="text" class="form-control" id="item" name="item" placeholder="Nama Item" value="{{$project->item}}" required>
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                        <strong>Tanggal Pengiriman :</strong>
                                        <input type="date" class="form-control" id="tgl_pengiriman" name="tgl_pengiriman" value="{{$project->tgl_pengiriman}}" >
                                </div> 
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                        <strong>Status</strong>
                                        <select class="form-select" name="status1" id="status1" value="{{$project->status1}}" >
                                            <option disabled selected option>{{$project->status1}}</option>
                                            <option value="Sudah Sampai">Sudah Sampai</option>
                                            <option value="Belum Sampai">Belum Sampai</option>
                                        </select>
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                        <strong>Tanggal Kembali :</strong>
                                        <input type="date" class="form-control @error('tgl_kembali') is-invalid @enderror" id="tgl_kembali" name="tgl_kembali" value="{{$project->tgl_kembali}}" >
                                        @error('tgl_kembali')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @enderror
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                        <strong>Status</strong>
                                        <select class="form-select" name="status2" id="status2" value="{{$project->status2}}" >
                                            <option disabled selected option>{{$project->status2}}</option>
                                            <option value="Sudah Sampai">Sudah Sampai</option>
                                            <option value="Belum Sampai">Belum Sampai</option>
                                        </select>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                        <strong>Comment <i>(Opsional)&ensp;</i>:</strong>
                                        <textarea class="form-control" name="comment" id="comment" cols="10" rows="5" value="{{$project->comment}}" placeholder="Komentar">{{$project->comment}}</textarea>
                                    </div>
                            </div> 
                            
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    @endif

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
                                        <li class="list-group-item"><b>Foto :&ensp;</b><img src="{{asset('/images/'.$project->image)}}" style="width:15%; height:15%;"></li>
                                    </div>
                                        <li class="list-group-item"><b>Item :&ensp;</b>{{$project->item}}</li>
                                        <li class="list-group-item"><b>Tanggal Pengiriman :&ensp;</b>{{$project->tgl_pengiriman}}</li>
                                        <li class="list-group-item"><b>Status :&ensp;</b>{{$project->status1}}</li>
                                        <li class="list-group-item"><b>Tanggal Kembali :&ensp;</b>{{$project->tgl_kembali}}</li>
                                        <li class="list-group-item"><b>Status :&ensp;</b>{{$project->status2}}</li>
                                        <li class="list-group-item"><b>Komentar :&ensp;</b>{{$project->comment}}</li>
                                        <li class="list-group-item"><b>Modified by :&ensp;</b>{{$project->id_user}}</li>
                                        <li class="list-group-item"><b>Date Modified :&ensp;</b>{{$project->date_modified}}</li>
                                    </ul>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            </td>
        </tr>

        <!-- JQuery -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script>
            $(function() {
                // Multiple images preview with JavaScript
                var multiImgPreview = function(input, imgPreviewPlaceholder) {
                    if (input.files) {
                        var filesAmount = input.files.length;
                        for (i = 0; i < filesAmount; $i++) {
                            var reader = new FileReader();
                            reader.onload = function(event) {
                                $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(imgPreviewPlaceholder);
                            }
                            reader.readAsDataURL(input.files[i]);
                        }
                    }
                };
                $('#image').on('change', function() {
                multiImgPreview(this, 'div.imgPreview');
            });
            });    
        </script>
        @endforeach
        
    </tbody>
</table>
<br>
Halaman : {{ $projects->currentPage() }} <br>
Jumlah Data : {{ $projects->total() }} <br><br>

{!!$projects->appends(Request::except('page'))->render()!!}

</div>

@endsection