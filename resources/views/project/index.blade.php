@extends('layout.master')

@section('content')

<!-- sweet alert -->
@include('sweetalert::alert')

<br>
<div class="row" style="padding-top: 6em;">
    <div style="text-align:center;">
        <h1>Form Data</h1>
    </div>
    @if(Auth::user()->type == 'admin')
    <form action="GET">
    <div class="form-group row" style="padding-left:2em;">
        <label for="" class="col-sm-2 col-form-label"></label>
       
    </div>
</form>
    <div class="col-lg-12 margin-tb">
        <div class="pull-left" style="padding-left: 2em;">            
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Tambah Data</button>
            <a class="btn btn-warning" href="{{ url('project/export') }}">Ekspor Excel</a>
        </div>
    </div>
</div>

  <!-- Modal -->
  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Tambah Data</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('project.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-4"><div class="form-group">
                        <strong>Nama Instansi</strong>
                        <input type="text" class="form-control" id="nama_instansi" name="nama_instansi" placeholder="Nama Instansi" autocomplete="off" value="{{old('nama_instansi')}}" required>
                    </div>
                </div>
                    <div class="col-4"><div class="form-group">
                        <strong>Nama Lokasi</strong>
                        <input type="text" class="form-control" id="nama_lokasi" name="nama_lokasi" placeholder="Nama Lokasi" autocomplete="off" value="{{old('nama_lokasi')}}"  required>
                    </div>
                </div>

                <div class="col-4">
                    <div class="form-group">
                       <strong>Teknisi</strong>
                        <select class="form-select" name="id_teknisi" id="id_teknisi" value="{{old('id_teknisi')}}"  required>    
                                <option disabled selected option>--Pilih--</option>
                            @foreach($teknisis as $teknisi)
                            @if($teknisi->aktif == 1)
                                <option value="{{$teknisi->id}}">{{$teknisi->nama_teknisi}} </option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                
                <div class="col-4">
                    <div class="form-group">
                        <strong>Produk</strong>
                        <select class="form-select" name="id_produk" id="id_produk" value="{{old('id_produk')}}" required> 
                                <option disabled selected option>--Pilih--</option>
                            @foreach($product as $produk)
                            @if($produk->aktif == 1)
                                <option value="{{$produk->id}}">{{$produk->nama_produk}}</option>
                                @endif
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
                            <strong>Prioritas</strong>
                            <select class="form-select" name="id_prioritas" id="id_prioritas" value="{{old('id_prioritas')}}"  required>
                                <option disabled selected option>--Pilih--</option>
                            @foreach($priorities as $priority)
                            @if($priority->aktif == 1)
                                <option value="{{$priority->id}}">{{$priority->nama_prioritas}}</option>
                                @endif
                            @endforeach
                            </select>
                        </div>
                </div>

                <div class="col-4">
                    <div class="form-group">
                            <strong>Jobdesk</strong>
                            <select class="form-select" name="id_jobdesk" id="id_jobdesk" value="{{old('jobdesk')}}"  required> 
                                <option disabled selected option>--Pilih--</option>
                            @foreach($jobdesks as $jobdesk)   
                            @if($jobdesk->aktif == 1) 
                                <option value="{{$jobdesk->id}}">{{$jobdesk->nama_jobdesk}}</option>
                                @endif
                            @endforeach
                            </select>
                        </div>
                </div>

                <div class="col-8">
                    <div class="form-group">
                            <strong>Deskripsi</strong>
                            <textarea class="form-control" name="deskripsi" id="deskripsi" cols="30" rows="10" value="{{old('deskripi')}}" placeholder="Deskripsi" required>{{old('deskripi')}}</textarea>
                        </div>
                </div>

                <div class="col-4">
                    <div class="form-group">
                            <strong>Status</strong>
                            <select class="form-select" name="id_status" id="id_status" value="{{old('nama_status')}}" required>
                                <option disabled selected option>--Pilih--</option>
                            @foreach($stattus as $status)
                            @if($status->aktif == 1)
                                <option value="{{$status->id}}">{{$status->nama_status}}</option>
                                @endif
                            @endforeach
                            </select>
                        </div>
                </div>
                
                <div class="col-8">
                    <div class="form-group">
                        <strong>Foto</strong>
                        <div class="user-image mb-3 text-center">
                            <div class="imgPreview"></div> 
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
                            <strong>Item</strong>
                            <input type="text" class="form-control" id="item" name="item" placeholder="Nama Item" value="{{old('item')}}" required>
                    </div>
                </div>

                <div class="col-3">
                    <div class="form-group">
                            <strong>Tanggal Pengiriman</strong>
                            <input type="date" class="form-control" id="tgl_pengiriman" name="tgl_pengiriman" value="{{old('tgl_pengiriman')}}">
                        </div> 
                </div>

                <div class="col-3">
                    <div class="form-group">
                            <strong>Status Pengiriman</strong>
                            <select class="form-select" name="status_pengiriman" id="status_pengiriman" value="{{old('status_pengiriman')}}">
                                <option disabled selected option>--Pilih--</option>
                                <option value="Sudah Sampai">Sudah Sampai</option>
                                <option value="Belum Sampai">Belum Sampai</option>
                            </select>
                        </div>
                </div>

                <div class="col-3">
                    <div class="form-group">
                            <strong>Tanggal Kembali</strong>
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
                            <strong>Status Kembali</strong>
                            <select class="form-select" name="status_kembali" id="status_kembali" value="{{old('status_kembali')}}">
                                <option disabled selected option>--Pilih--</option>
                                <option value="Sudah Sampai">Sudah Sampai</option>
                                <option value="Belum Sampai">Belum Sampai</option>
                            </select>
                        </div> 
                </div>
                <div class="col-4">
                    <div class="form-group">
                            <strong>Comment <i style="opacity:0.5;">(Opsional)&ensp;</i></strong>
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
    <thead style="text-align:center;">
        <tr>
            <th><b>No</b></th>
            <th><b>@sortablelink('tanggal','Tanggal')</b></th>
            <th><b>@sortablelink('nama_instansi','Nama Instansi')</b></th>
            <th><b>@sortablelink('nama_lokasi','Nama Lokasi')</b></th>
            <th><b>@sortablelink('id_teknisi','Teknisi')</b></th>
            <th><b>Produk</b></th>
            <th><b>Warranty</b></th>
            <!-- <th>Priority</th>
            <th>Jobdesk</th>
            <th>Deskripsi</th>
            <th>Status</th>
            <th>Foto</th>
            <th>Item</th>
            <th>Tgl Pengiriman</th>
            <th>Status Pengiriman</th>
            <th>Tgl Kembali</th>
            <th>Status Kembali</th>
            <th>Comment</th>
            <th>Nama User</th>
            <th>Date Modified</th> -->
            <th>Aksi</th>            
           
        </tr>
    </thead>
    <tbody>
        <?php       
        $i= 0;
         ?>
         
        @foreach($projects as $project)
        <tr>
            <td style="text-align:center;">{{ ++$i }}</td>
            <td style="text-align:center;">{{ $project->tanggal }}</td>
            <td>{{ $project->nama_instansi }}</td>
            <td>{{ $project->nama_lokasi }}</td>
            <td>{{ $project->nama_teknisi }}</td>
            <td>{{ $project->nama_produk }}</td>
            <td>{{ $project->warranty }}</td>
       <!-- <td>{{ $project->nama_prioritas }}</td>
            <td>{{ $project->nama_jobdesk }}</td>
            <td>{{ $project->deskripsi }}</td>
            <td>{{ $project->nama_status }}</td> 
            <td>{{ $project->image }}</td>
            <td>{{ $project->item }}</td>
            <td>{{ $project->tgl_pengiriman }}</td>
            <td>{{ $project->status_pengiriman }}</td>
            <td>{{ $project->tgl_kembali }}</td>
            <td>{{ $project->status_kembali }}</td>
            <td>{{ $project->comment }}</td>
            <td>{{ $project->name }}</td>
            <td>{{ $project->date_modified }}</td> -->
            <td style="text-align:center;">
                <a class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalShow{{$project->id}}"><ion-icon name="eye-outline"></ion-icon></a> 
                @if(Auth::user()->type == 'admin')
                <form action="{{route('project.destroy',$project->id)}}" method="post" enctype="multipart/form-data">
                <a class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalUpdate{{$project->id}}"><ion-icon name="pencil-sharp"></ion-icon></a>
                    <!-- <a href="{{route('project.show',$project->id)}}" class="btn btn-info"><ion-icon name="search-outline"></ion-icon></a> -->                    
                    @csrf 
                    @method('DELETE')
                </form>
            </td>

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
                                    <strong>Nama Instansi</strong>
                                    <input type="text" class="form-control" id="nama_instansi" name="nama_instansi" placeholder="Nama Instansi" autocomplete="off" value="{{$project->nama_instansi}}"  >
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <strong>Nama Lokasi</strong>
                                    <input type="text" class="form-control" id="nama_lokasi" name="nama_lokasi" placeholder="Nama Lokasi" autocomplete="off" value="{{$project->nama_lokasi}}"  >
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                <strong>Teknisi</strong>
                                    <select class="form-select" name="id_teknisi" id="id_teknisi" value="{{$project->nama_teknisi}}"  >    
                                            <option disabled selected option>{{$project->nama_teknisi}}</option>
                                        @foreach($teknisis as $teknisi)
                                        @if($teknisi->aktif == 1)
                                            <option value="{{$teknisi->id}}">{{$teknisi->nama_teknisi}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-4">
                                <div class="form-group">
                                    <strong>Produk</strong>
                                    <select class="form-select" name="id_produk" id="id_produk" value="{{$project->nama_produk}}"  > 
                                            <option disabled selected option>{{$project->nama_produk}}</option>
                                        @foreach($product as $produk)
                                        @if($produk->aktif == 1)
                                            <option value="{{$produk->id}}">{{$produk->nama_produk}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-2">
                                <div class="form-group">
                                    <strong>Warranty</strong>
                                    <select class="form-select" name="warranty" id="warranty" value="{{$project->warranty}}"  >
                                            <option disabled selected option>{{$project->warranty}}</option>
                                            <option value="Garansi">Garansi</option>
                                            <option value="Non - Garansi">Non - Garansi</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-2">
                                <div class="form-group">
                                        <strong>Prioritas</strong>
                                        <select class="form-select" name="id_prioritas" id="id_prioritas" value="{{$project->nama_prioritas}}"  >
                                            <option disabled selected option>{{$project->nama_prioritas}}</option>
                                        @foreach($priorities as $priority)
                                        @if($priority->aktif == 1)
                                            <option value="{{$priority->id}}">{{$priority->nama_prioritas}}</option>
                                            @endif
                                        @endforeach
                                        </select>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                        <strong>Jobdesk</strong>
                                        <select class="form-select" name="id_jobdesk" id="id_jobdesk" value="{{$project->nama_jobdesk}}"  > 
                                            <option disabled selected option>{{$project->nama_jobdesk}}</option>
                                        @foreach($jobdesks as $jobdesk)   
                                        @if($jobdesk->aktif == 1) 
                                            <option value="{{$jobdesk->id}}">{{$jobdesk->nama_jobdesk}}</option>
                                            @endif
                                        @endforeach
                                        </select>
                                </div>
                            </div>

                            <div class="col-8">
                                <div class="form-group">
                                        <strong>Deskripsi</strong>
                                        <textarea class="form-control" name="deskripsi" id="deskripsi" cols="30" rows="10" value="{{$project->deskripsi}}" placeholder="Deskripsi" >{{$project->deskripsi}}</textarea>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                        <strong>Status</strong>
                                        <select class="form-select" name="id_status" id="id_status" value="{{$project->nama_status}}" >
                                            <option disabled selected option>{{$project->nama_status}}</option>
                                        @foreach($stattus as $status)
                                        @if($status->aktif == 1)
                                            <option value="{{$status->id}}">{{$status->nama_status}}</option>
                                            @endif
                                        @endforeach
                                        </select>
                                </div>
                            </div>

                            <div class="col-8">
                                <div class="form-group">
                                    <strong>Foto</strong> 
                                    <div class="user-image mb-3 text-center col-8" style="max-heigth:200%;">
                                        <div class="imgPreview"></div>
                                        @if($project->image)
                                        <img src="{{asset('/images/'.$project->image)}}" class="img-thumbnail">
                                        @else
                                        <span class="badge badge-danger">Belum ada Foto</span>
                                        @endif
                                    </div>                                  

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
                                        <strong>Item</strong>
                                        <input type="text" class="form-control" id="item" name="item" placeholder="Nama Item" value="{{$project->item}}" >
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                        <strong>Tanggal Pengiriman</strong>
                                        <input type="date" class="form-control" id="tgl_pengiriman" name="tgl_pengiriman" value="{{$project->tgl_pengiriman}}" >
                                </div> 
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                        <strong>Status Pengiriman</strong>
                                        <select class="form-select" name="status_pengiriman" id="status_pengiriman" value="{{$project->status_pengiriman}}" >
                                            <option disabled selected option>{{$project->status1}}</option>
                                            <option value="Sudah Sampai">Sudah Sampai</option>
                                            <option value="Belum Sampai">Belum Sampai</option>
                                        </select>
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                        <strong>Tanggal Kembali</strong>
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
                                        <strong>Status Kembali</strong>
                                        <select class="form-select" name="status_kembali" id="status_kembali" value="{{$project->status_kembali}}" >
                                            <option disabled selected option>{{$project->status2}}</option>
                                            <option value="Sudah Sampai">Sudah Sampai</option>
                                            <option value="Belum Sampai">Belum Sampai</option>
                                        </select>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                        <strong>Comment <i>(Opsional)&ensp;</i></strong>
                                        <textarea class="form-control" name="comment" id="comment" cols="10" rows="5" value="{{$project->comment}}" placeholder="Komentar">{{$project->comment}}</textarea>
                                    </div>
                            </div> 
                            
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary"><ion-icon name="checkmark-outline"></ion-icon> Submit</button>
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
                            <h5 class="modal-title" id="staticBackdropLabel">Detail Data</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <form method="POST" enctype="multipart/form-data" id="showForm">
                            @csrf
                                <div class="card-body">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item"><b>Tanggal:&ensp;</b>{{$project->tanggal}}</li>
                                        <li class="list-group-item"><b>Nama Instansi:&ensp;</b>{{$project->nama_instansi}}</li>
                                        <li class="list-group-item"><b>Nama Lokasi:&ensp;</b>{{$project->nama_lokasi}}</li>
                                        <li class="list-group-item"><b>Teknisi:&ensp;</b>{{$project->nama_teknisi}}</li>
                                        <li class="list-group-item"><b>Produk:&ensp;</b>{{$project->nama_produk}}</li>
                                        <li class="list-group-item"><b>Warranty:&ensp;</b>{{$project->warranty}}</li>
                                        <li class="list-group-item"><b>Priority:&ensp;</b>{{$project->nama_prioritas}}</li>
                                        <li class="list-group-item"><b>Jobdesk:&ensp;</b>{{$project->nama_jobdesk}}</li>
                                        <li class="list-group-item"><b>Deskripsi:&ensp;</b>{{$project->deskripsi}}</li>
                                        <li class="list-group-item"><b>Status:&ensp;</b>{{$project->nama_status}}</li>
                                    <div style="max-height:200px;">
                                        <li class="list-group-item"><b>Foto:&ensp;</b><img src="{{asset('/images/'.$project->image)}}" style="width:15%; height:15%;"></li>
                                    </div>
                                        <li class="list-group-item"><b>Item:&ensp;</b>{{$project->item}}</li>
                                        <li class="list-group-item"><b>Tanggal Pengiriman:&ensp;</b>{{$project->tgl_pengiriman}}</li>
                                        <li class="list-group-item"><b>Status Pengiriman:&ensp;</b>{{$project->status_pengiriman}}</li>
                                        <li class="list-group-item"><b>Tanggal Kembali:&ensp;</b>{{$project->tgl_kembali}}</li>
                                        <li class="list-group-item"><b>Status Kembali:&ensp;</b>{{$project->status_kembali}}</li>
                                        <li class="list-group-item"><b>Komentar:&ensp;</b>{{$project->comment}}</li>
                                        <li class="list-group-item"><b>Modified by:&ensp;</b>{{$project->name}}</li>
                                        <li class="list-group-item"><b>Date Modified:&ensp;</b>{{$project->date_modified}}</li>
                                    </ul>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            
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



</div>

@endsection