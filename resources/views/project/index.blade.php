@extends('layout.master')

@section('content')

<!-- sweet alert -->
@include('sweetalert::alert')

<script>
    var host = window.location.protocol + "//" + window.location.host;
    window.history.pushState('', '', host+"/project");

    var input = document.getElementById("input"),
        selectBox = document.getElementById("selectBox");

    //function onLoad() {
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        if(urlParams.has('filter')){
            selectBox.value = urlParams.get('filter');
            input.value = urlParams.get('input');
        }else{
            selectBox.value = "semua";
            input.value = "";
        }
    //}

    // function changeType() {
    //     var input = document.getElementById("input"),
    //         selectBox = document.getElementById("selectBox");

    //     if(selectBox.value == "tanggal" || selectBox.value == "tgl_pengiriman" || selectBox.value == "tgl_kembali"){
    //         input.type = "date";
    //     }else{
    //         input.type = "search";
    //     }
    // }
</script>

<br>
<div class="row" style="padding-top: 6em;">
    <div style="text-align:center;">
        <h1>Form Data</h1>
    </div>
    @if(Auth::user()->type == 'admin' || Auth::user()->type == 'user')
    <form action="GET">
    <div class="form-group row" style="padding-left:2em;">
        <label for="" class="col-sm-2 col-form-label"></label>
       
    </div>
</form>
    <div class="col-lg-12 margin-tb">
        <div style="padding-left: 2em;">

            <!-- Button trigger modal -->
            <div class="row">
                <div class="col-lg-4">
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Tambah Data</button>
                    <!-- <a class="btn btn-warning" href="{{ url('project/export') }}">Ekspor Excel</a> -->
                    <button id="btn_ekspor" class="btn btn-warning">Ekspor Excel</button>
                </div> 
                <div class="col-lg-2"></div>
                <div class="col-lg-6">

<!-- Fungsi ubah type input -->
<script>
    $(document).on("change", ".seletOption", function() {
        var selected = $(this).find('option:selected').text();
        var $form = $(this).closest("form");
        var remarks = $form.find(".remarks").val();

        $form.find('.remarks').toggle(selected != 'Tanggal' && selected != 'Tanggal Pengiriman' && selected != 'Tanggal Kembali' 
                                    && selected != 'Warranty' && selected != 'Status Pengiriman' && selected != 'Status Kembali');
        $form.find('.date').toggle(selected == 'Tanggal' || selected == 'Tanggal Pengiriman' || selected == 'Tanggal Kembali');
        $form.find('.jaminan').toggle(selected == 'Warranty');
        $form.find('.status').toggle(selected == 'Status Pengiriman' || selected == 'Status Kembali');
    });
</script>

                    <!-- Form Search Data -->
                    <form class="row" method="GET">
                        <div class="col-auto">
                            <div style="width: 200px;">
                                <select class="form-select seletOption" name="filter" id="selectBox" value="{{ ($projects['filter']) }}" onblur="this.size=1;" onchange="changeType();this.size=1;this.blur();">
                                    <option value="semua">Semua</option>
                                    <option value="tanggal">Tanggal</option>
                                    <option value="nama_instansi">Nama Instansi</option>
                                    <option value="nama_lokasi">Nama Lokasi</option>
                                    <option value="teknisi">Teknisi</option>
                                    <option value="produk">Produk</option>
                                    <option value="warranty">Warranty</option>
                                    <option value="prioritas">Prioritas</option>
                                    <option value="jobdesk">Jobdesk</option>
                                    <option value="status">Status Pekerjaan</option>
                                    <option value="item">Item</option>
                                    <option value="tgl_pengiriman">Tanggal Pengiriman</option>
                                    <option value="status_pengiriman">Status Pengiriman</option>
                                    <option value="tgl_kembali">Tanggal Kembali</option>
                                    <option value="status_kembali">Status Kembali</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-auto">
                            <input type="search" id="input" name="keyword" class="form-control remarks" value="{{ ($projects['keyword']) }}" placeholder="Cari..." style="width:250px;">
                            <input type="date" class="form-control date" style="display: none; width:250px;" name="date" value="{{ ($projects['date']) }}">
                            <select class="form-select jaminan" name="select" id="" style="display: none; width:250px;" value="{{ ($projects['select']) }}">
                                <option value="">Pilih</option>
                                <option value="Garansi">Garansi</option>
                                <option value="Non-Garansi">Non Garansi</option>
                            </select>
                            <select class="form-select status" name="status" id="" style="display: none; width:250px;" value="{{ ($projects['status']) }}">
                                <option disabled>Pilih</option>
                                <option value="Sudah Sampai">Sudah Sampai</option>
                                <option value="Belum Sampai">Belum Sampai</option>
                            </select>
                        </div>

                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary mb-3">Cari</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

  <!-- Modal Tambah Data -->
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
                        <div class="col-6">
                            <div class="form-group">
                                <strong>Nama Instansi</strong>
                                <input type="text" class="form-control" id="nama_instansi" name="nama_instansi" placeholder="Nama Instansi" autocomplete="off" value="{{old('nama_instansi')}}" required>
                                @error('nama_instansi')
                                    <div class="text-danger">* {{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <strong>Nama Lokasi</strong>
                                <input type="text" class="form-control" id="nama_lokasi" name="nama_lokasi" placeholder="Nama Lokasi" autocomplete="off" value="{{old('nama_lokasi')}}" required>
                                @error('nama_lokasi')
                                    <div class="text-danger">* {{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="form-group">
                                <strong>Teknisi</strong>
                                <select class="form-select" name="id_teknisi" id="id_teknisi" value="{{old('id_teknisi')}}" required>    
                                        <option value="">--Pilih--</option>
                                    @foreach($teknisis as $teknisi)
                                    @if($teknisi->aktif == 1)
                                        <option value="{{$teknisi->id}}">{{$teknisi->nama_teknisi}} </option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('id_teknisi')
                                    <div class="text-danger">* {{ $message }}</div>
                                @enderror
                            </div>
                        </div>                
                        
                        <div class="col-3">
                            <div class="form-group">
                                <strong>Produk</strong>
                                <select class="form-select" name="id_produk" id="id_produk" value="{{old('id_produk')}}" required> 
                                    <option value="">--Pilih--</option>
                                @foreach($product as $produk)
                                    @if($produk->aktif == 1)
                                    <option value="{{$produk->id}}">{{$produk->nama_produk}}</option>
                                    @endif
                                @endforeach
                                </select>
                                @error('id_produk')
                                    <div class="text-danger">* {{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="form-group">
                                <strong>Warranty</strong>
                                <select class="form-select" name="warranty" id="warranty" value="{{old('warranty')}}" required>
                                    <option value="">--Pilih--</option>
                                    <option value="Garansi">Garansi</option>
                                    <option value="Non-Garansi">Non Garansi</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="form-group">
                                <strong>Prioritas</strong>
                                <select class="form-select" name="id_prioritas" id="id_prioritas" value="{{old('id_prioritas')}}" required>
                                    <option value="">--Pilih--</option>
                                @foreach($priorities as $priority)
                                    @if($priority->aktif == 1)
                                    <option value="{{$priority->id}}">{{$priority->nama_prioritas}}</option>
                                    @endif
                                @endforeach
                                </select>
                                @error('id_prioritas')
                                    <div class="text-danger">* {{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <strong>Jobdesk</strong>
                                <select class="form-select" name="id_jobdesk" id="id_jobdesk" value="{{old('jobdesk')}}" required> 
                                    <option value="">--Pilih--</option>
                                @foreach($jobdesks as $jobdesk)   
                                    @if($jobdesk->aktif == 1) 
                                    <option value="{{$jobdesk->id}}">{{$jobdesk->nama_jobdesk}}</option>
                                    @endif
                                @endforeach
                                </select>
                                @error('id_jobdesk')
                                    <div class="text-danger">* {{$message}}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <strong>Status Pekerjaan</strong>
                                <select class="form-select" name="id_status" id="id_status" value="{{old('nama_status')}}" required>
                                    <option value="">--Pilih--</option>
                                @foreach($stattus as $status)
                                    @if($status->aktif == 1)
                                    <option value="{{$status->id}}">{{$status->nama_status}}</option>
                                    @endif
                                @endforeach
                                </select>
                                @error('id_status')
                                    <div class="text-danger">* {{ $message }}</div>
                                @enderror
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
                                    <option value="">--Pilih--</option>
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
                                    <div class="invalid-feedback">* {{$message}}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="form-group">
                                <strong>Status Kembali</strong>
                                <select class="form-select" name="status_kembali" id="status_kembali" value="{{old('status_kembali')}}">
                                    <option value="">--Pilih--</option>
                                    <option value="Sudah Sampai">Sudah Sampai</option>
                                    <option value="Belum Sampai">Belum Sampai</option>
                                </select>
                            </div> 
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <strong>Deskripsi</strong>
                                <textarea class="form-control" name="deskripsi" id="deskripsi" cols="30" rows="10" value="{{old('deskripi')}}" placeholder="Deskripsi" required>{{old('deskripi')}}</textarea>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <strong>Item</strong>
                                <input type="text" class="form-control" id="item" name="item" placeholder="Nama Item" value="{{old('item')}}" required>
                            </div>
                        </div>
                        
                        <div class="col-6">
                            <div class="form-group">
                                <strong>Foto</strong>
                                <div class="user-image mb-3 text-center">
                                    <div class="imgPreview"></div>                                                                       
                                    <input type="file" class="form-control  @error('image') is-invalid @enderror" id="image" accept="image/*" name="image[]" multiple>
                                </div>
                                @error('image')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                        </div>
                                
                        <div class="col-6">
                            <div class="form-group">
                                <strong>Komentar <i style="opacity:0.5;">(Opsional)&ensp;</i></strong>
                                <textarea class="form-control" name="komentar" id="komentar" cols="10" rows="5" value="{{old('komentar')}}" placeholder="Komentar">{{old('komentar')}}</textarea>
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
  </div>

@endif

<div style="padding:2em">
<table class="table table-bordered table-striped table-hover table-responsive data-table">
    <thead style="text-align:center;">
        <tr>
            <th><b>No</b></th>
            <th><b>Tanggal</b></th>
            <th><b>Nama Instansi</b></th>
            <th><b>Nama Lokasi</b></th>
            <th><b>Teknisi</b></th>
            <th><b>Produk</b></th>
            <th><b>Warranty</b></th>
            <!-- <th>Priority</th>
            <th>Jobdesk</th>
            <th>Deskripsi</th>
            <th>Status Pekerjaan</th>
            <th>Foto</th>
            <th>Item</th>
            <th>Tgl Pengiriman</th>
            <th>Status Pengiriman</th>
            <th>Tgl Kembali</th>
            <th>Status Kembali</th>
            <th>Komentar</th>
            <th>Nama User</th>
            <th>Date Modified</th> -->
            <th><b>Aksi</b></th>            
           
        </tr>
    </thead>
    <tbody>
        <?php       
        $i= 1 + (($projects->currentPage()- 1) * $projects->perPage());
         ?>
         
        @forelse($projects as $project)
        <tr>
            <td style="text-align:center;">{{ $i++ }}</td>
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
            <td>{{ $project->image }} </td>
            <td>{{ $project->item }}</td>
            <td>{{ $project->tgl_pengiriman }}</td>
            <td>{{ $project->status_pengiriman }}</td>
            <td>{{ $project->tgl_kembali }}</td>
            <td>{{ $project->status_kembali }}</td>
            <td>{{ $project->komentar }}</td>
            <td>{{ $project->name }}</td>
            <td>{{ $project->date_modified }}</td>  -->
            <td style="text-align:center;">
                <a class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalShow{{$project->id}}"><ion-icon name="eye-outline"></ion-icon></a> 
                @if(Auth::user()->type == 'admin' || Auth::user()->type == 'user')
                <form action="{{route('project.destroy',$project->id)}}" method="post" enctype="multipart/form-data">
                    <a class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalUpdate{{$project->id}}"><ion-icon name="pencil-sharp"></ion-icon></a>                                       
                    @csrf 
                    @method('DELETE')
                </form>
                    <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalComment{{$project->id}}"><ion-icon name="chatbox-ellipses-outline"></ion-icon></a>
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
                            <div class="col-6">
                                <div class="form-group">
                                    <strong>Nama Instansi</strong>
                                    <input type="text" class="form-control" id="nama_instansi" name="nama_instansi" placeholder="Nama Instansi" autocomplete="off" value="{{$project->nama_instansi}}">
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <strong>Nama Lokasi</strong>
                                    <input type="text" class="form-control" id="nama_lokasi" name="nama_lokasi" placeholder="Nama Lokasi" autocomplete="off" value="{{$project->nama_lokasi}}">
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                <strong>Teknisi</strong>
                                    <select class="form-select" name="id_teknisi" id="id_teknisi" value="{{$project->nama_teknisi}}">    
                                            <option disabled selected option>{{$project->nama_teknisi}}</option>
                                        @foreach($teknisis as $teknisi)
                                            @if($teknisi->aktif == 1)
                                            <option value="{{$teknisi->id}}" {{ ($teknisi->id == $project->id_teknisi) ? 'selected' : ''}}>{{$teknisi->nama_teknisi}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-3">
                                <div class="form-group">
                                    <strong>Produk</strong>
                                    <select class="form-select" name="id_produk" id="id_produk" value="{{$project->nama_produk}}"> 
                                            <option disabled selected option>{{$project->nama_produk}}</option>
                                        @foreach($product as $produk)
                                            @if($produk->aktif == 1)
                                            <option value="{{$produk->id}}" {{ ($produk->id == $project->id_produk) ? 'selected' : ''}}>{{$produk->nama_produk}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                    <strong>Warranty</strong>
                                    <select class="form-select" name="warranty" id="warranty" value="{{$project->warranty}}">
                                            <option disabled selected option>{{$project->warranty}}</option>
                                            <option value="Garansi" {{ ($project->warranty == 'Garansi') ? 'selected' : ''}}>Garansi</option>
                                            <option value="Non-Garansi" {{ ($project->warranty == 'Non-Garansi') ? 'selected' : ''}}>Non Garansi</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                        <strong>Prioritas</strong>
                                        <select class="form-select" name="id_prioritas" id="id_prioritas" value="{{$project->nama_prioritas}}">
                                            <option disabled selected option>{{$project->nama_prioritas}}</option>
                                        @foreach($priorities as $priority)
                                            @if($priority->aktif == 1)
                                            <option value="{{$priority->id}}" {{ ($priority->id == $project->id_prioritas) ? 'selected' : ''}}>{{$priority->nama_prioritas}}</option>
                                            @endif
                                        @endforeach
                                        </select>
                                </div>
                            </div>
                            
                            <div class="col-6">
                                <div class="form-group">
                                        <strong>Jobdesk</strong>
                                        <select class="form-select" name="id_jobdesk" id="id_jobdesk" value="{{$project->nama_jobdesk}}"> 
                                            <option disabled selected option>{{$project->nama_jobdesk}}</option>
                                        @foreach($jobdesks as $jobdesk)   
                                            @if($jobdesk->aktif == 1) 
                                            <option value="{{$jobdesk->id}}" {{ ($jobdesk->id == $project->id_jobdesk) ? 'selected' : ''}}>{{$jobdesk->nama_jobdesk}}</option>
                                            @endif
                                        @endforeach 
                                        </select>                                        
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                        <strong>Status Pekerjaan</strong>
                                        <select class="form-select" name="id_status" id="id_status" value="{{$project->nama_status}}">
                                            <option disabled selected option>{{$project->nama_status}}</option>
                                        @foreach($stattus as $status)
                                            @if($status->aktif == 1)
                                            <option value="{{$status->id}}" {{ ($status->id == $project->id_status) ? 'selected' : ''}}>{{$status->nama_status}}</option>
                                            @endif
                                        @endforeach
                                        </select>
                                        @error('id_status')
                                            <div class="text-danger">
                                               * {{$message}}
                                            </div>
                                        @enderror                                    
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                    <strong>Tanggal Pengiriman</strong>
                                    <input type="date" class="form-control" id="tgl_pengiriman" name="tgl_pengiriman" value="{{$project->tgl_pengiriman}}">
                                </div> 
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                    <strong>Status Pengiriman</strong>
                                    <select class="form-select" name="status_pengiriman" id="status_pengiriman" value="{{$project->status_pengiriman}}">
                                        <option disabled selected option>{{$project->status_pengiriman}}</option>
                                        <option value="Sudah Sampai" {{$project->status_pengiriman == 'Sudah Sampai' ? 'selected' : ''}}>Sudah Sampai</option>
                                        <option value="Belum Sampai" {{$project->status_pengiriman == 'Belum Sampai' ? 'selected' : ''}}>Belum Sampai</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                    <strong>Tanggal Kembali</strong>
                                    <input type="date" class="form-control @error('tgl_kembali') is-invalid @enderror" id="tgl_kembali" name="tgl_kembali" value="{{$project->tgl_kembali}}">
                                    @error('tgl_kembali')
                                        <div class="invalid-feedback">* {{$message}}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                    <strong>Status Kembali</strong>
                                    <select class="form-select" name="status_kembali" id="status_kembali" value="{{$project->status_kembali}}">
                                        <option disabled selected option>{{$project->status_kembali}}</option>
                                        <option value="Sudah Sampai" {{$project->status_kembali == 'Sudah Sampai' ? 'selected' : ''}}>Sudah Sampai</option>
                                        <option value="Belum Sampai" {{$project->status_kembali == 'Belum Sampai' ? 'selected' : ''}}>Belum Sampai</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                        <strong>Deskripsi</strong>
                                        <textarea class="form-control" name="deskripsi" id="deskripsi" cols="30" rows="10" value="{{$project->deskripsi}}" placeholder="Deskripsi" >{{$project->deskripsi}}</textarea>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <strong>Item</strong>
                                    <input type="text" class="form-control" id="item" name="item" placeholder="Nama Item" value="{{$project->item}}">
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <strong>Foto</strong> 
                                    <div class="user-image mb-3 text-center col-8" style="max-height: 100%;">                                                                                                       
                                    <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image[]" value="{{$project->image}}" accept="images/*" multiple>
                                    @error('image')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary"><ion-icon name="checkmark-outline"></ion-icon> Submit</button>
                            </div>
                        </div>

                    </form>
                    <div class="imgPreview"></div>
                        @foreach($images as $img)
                        <form action="{{ url('project/deleteImage', $img->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                                @if($img->data_id == $project->id)
                                <input type="checkbox" name="multi_delete[]" value="{{ $img->id }}">
                                <img src="/images/{{ $img->image }}" class="rounded float-left" style="width:145px;">
                                <a href="{{ url('project/download', $img->id) }}" class="btn btn-primary"><ion-icon name="download-outline"></ion-icon>Unduh</a>&emsp;
                                @endif
                        @endforeach
                            <div class="pull-left mt-2">
                                <button class="btn btn-danger" onclick="return confirm('Yakin hapus foto?');"><ion-icon name="trash-outline"></ion-icon>Hapus</button>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Input komentar dan foto -->

    <div class="modal fade" id="modalComment{{$project->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Masukkan Komentar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">                    
                    <form action="{{ route('project.uploadImage',$project->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf                        
                            <div class="col-12">
                                <div class="form-group">
                                    <strong>Komentar</strong>
                                    <textarea class="form-control" name="komentar" id="komentar" cols="10" rows="5" value="{{$project->komentar}}" placeholder="Komentar" required>{{$project->komentar}}</textarea>
                                    
                                    <input type="hidden" value="{{$project->id}}" name="id_data" id="id_data">                                    
                                    
                                </div>
                            </div> 

                        <div class="col-12">
                                <div class="form-group">
                                    <strong>Foto</strong>
                                    <input type="file" class="form-control" name="image[]" accept="image/*" multiple>
                                    
                                    <input type="hidden" value="{{$project->id}}" name="id_data" id="id_data">
                                    
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary" id="submit"><ion-icon name="checkmark-outline"></ion-icon> Submit</button>
                            </div>
                    </form>
                            
                </div>
            </div>
        </div>
    </div>
    @endif

            <!-- Modal Show -->
            <div class="modal fade" id="modalShow{{$project->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Detail Data</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" style="text-align:left;">

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
                                        <li class="list-group-item"><b>Status Pekerjaan:&ensp;</b>{{$project->nama_status}}</li>
                                        <li class="list-group-item"><b>Item:&ensp;</b>{{$project->item}}</li>
                                        <li class="list-group-item"><b>Tanggal Pengiriman:&ensp;</b>{{$project->tgl_pengiriman}}</li>
                                        <li class="list-group-item"><b>Status Pengiriman:&ensp;</b>{{$project->status_pengiriman}}</li>
                                        <li class="list-group-item"><b>Tanggal Kembali:&ensp;</b>{{$project->tgl_kembali}}</li>
                                        <li class="list-group-item"><b>Status Kembali:&ensp;</b>{{$project->status_kembali}}</li>
                                        <li class="list-group-item"><b>Komentar:&ensp;</b>
                                            <br>
                                            
                                            @foreach($comments as $komen)
                                                @if($komen->id_data == $project->id)
                                                <div style="max-height: 100%;">                                               
                                                    {{ $komen->created_at }} &nbsp;&nbsp; {{ $komen->name }}: &nbsp;&nbsp; {{ $komen->komentar }} &nbsp;&nbsp; @foreach($images as $img) @if($komen->id == $img->comment_id)<img src="{{ asset('images/'.$img->image) }}" style="width:7%; height:7%;"> @endif @endforeach &nbsp;&nbsp; <br>
                                                    </div>  
                                                @endif
                                            @endforeach
                                        </li>
                                        <li class="list-group-item"><b>Semua Foto:&ensp;</b>
                                            <br>
                                            @foreach($images as $img)
                                                @if($img->data_id == $project->id)
                                                <img src="/images/{{ $img->image }}" style="width:15%; height:15%;"> &nbsp;&nbsp;
                                                @endif
                                            @endforeach
                                        </li>
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
        @empty
        <tr>
            <td colspan="12" style="text-align:center;">Tidak ada data</td>
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
        @endforelse
    </tbody>
    
</table>

<br>

    <!-- tabel expor data -->
    <table id="datas" style="display: none;">
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Nama Instansi</th>
            <th>Nama Lokasi</th>
            <th>Teknisi</th>
            <th>Produk</th>
            <th>Warranty</th>
            <th>Priority</th>
            <th>Jobdesk</th>
            <th>Deskripsi</th>
            <th>Status Pekerjaan</th>
            <th>Item</th>
            <th>Tanggal Pengiriman</th>
            <th>Status Pengiriman</th>
            <th>Tanggal Kembali</th>
            <th>Status Kembali</th>
            <th>Komentar</th>
            <th>Nama User</th>
            <th>Date Modified</th>
        </tr>
        <?php $i= 0; ?>
        @foreach($projects as $project)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $project->tanggal }}</td>
            <td>{{ $project->nama_instansi }}</td>
            <td>{{ $project->nama_lokasi }}</td>
            <td>{{ $project->nama_teknisi }}</td>
            <td>{{ $project->nama_produk }}</td>
            <td>{{ $project->warranty }}</td>
            <td>{{ $project->nama_prioritas }}</td>
            <td>{{ $project->nama_jobdesk }}</td>
            <td>{{ $project->deskripsi }}</td>
            <td>{{ $project->nama_status }}</td>
            <td>{{ $project->item }}</td>
            <td>{{ $project->tgl_pengiriman }}</td>
            <td>{{ $project->status_pengiriman }}</td>
            <td>{{ $project->tgl_kembali }}</td>
            <td>{{ $project->status_kembali }}</td>
            <td>@foreach($comments as $komen)
                    @if($komen->id_data == $project->id)
                        {{ $komen->created_at }} &nbsp;&nbsp; {{ $komen->name }} &nbsp;&nbsp; {{ $komen->komentar }}<br>
                    @endif
                @endforeach
            </td>
            <td>{{ $project->name }}</td>
            <td>{{ $project->date_modified }}</td>
        </tr>
        @endforeach
    </table>

    {{ $projects->appends(request()->except('page'))->links() }}
</div>

<!-- Fungsi expor data -->
<script type="text/javascript">
    jQuery(document).ready(function($) {
        $("#btn_ekspor").click(function(){
            $("#datas").table2excel({
                filename: "Data.xls"
            });
        });
    });
</script>

@endsection