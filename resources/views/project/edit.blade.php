@extends('layout.master')
@section('content')

<div class="container">
    <div class="jumbotron">
    <h1 class="display-6">Edit Data</h1> <br>
            <form action="{{ route('project.update',$project->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                    <div class="form-group">
                        <strong>Nama Instansi :</strong>
                        <input type="text" class="form-control" id="nama_instansi" name="nama_instansi" placeholder="Nama Instansi" autocomplete="off" required value="{{$project->nama_instansi}}">
                    </div>

                    <div class="form-group">
                        <strong>Nama Lokasi :</strong>
                        <input type="text" class="form-control" id="nama_lokasi" name="nama_lokasi" placeholder="Nama Lokasi" autocomplete="off" required value="{{$project->nama_lokasi}}">
                    </div>

                    <div class="form-group">
                       <strong>Teknisi</strong>
                        <select class="form-select" name="nama_teknisi" id="nama_teknisi" required>
                            <option value="{{$project->nama_teknisi}}">{{$project->nama_teknisi}}</option>
                            @foreach($teknisis as $teknisi)
                            <option value="{{$teknisi->nama_teknisi}}">{{$teknisi->nama_teknisi}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <strong>Produk</strong>
                       <select class="form-select" name="produk" id="produk" required>
                        <option value="{{$project->produk}}">{{$project->produk}}</option>
                        @foreach($product as $produk)
                        <option value="{{$produk->nama_produk}}">{{$produk->nama_produk}}</option>
                        @endforeach
                       </select>
                    </div>

                    <div class="form-group">
                        <strong>Warranty</strong>
                        <select class="form-select" name="warranty" id="warranty" required>
                            <option value="{{$project->warranty}}">{{$project->warranty}}</option>
                            <option value="Garansi">Garansi</option>
                            <option value="Non - Garansi">Non - Garansi</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <strong>Priority</strong>
                        <select class="form-select" name="priority" id="priority" required>
                            <option value="{{$project->priority}}">{{$project->priority}}</option>
                            @foreach($priorittas as $prioritas)
                            <option value="{{$prioritas->jenis_prioritas}}">{{$prioritas->jenis_prioritas}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <strong>Jobdesk</strong>
                        <select class="form-select" name="jobdesk" id="jobdesk" required>
                            <option value="{{$project->jobdesk}}">{{$project->jobdesk}}</option>
                            @foreach($jobdesks as $jobdesk)
                            <option value="{{$jobdesk->jenis_j}}">{{$jobdesk->jenis_j}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <strong>Deskripsi :</strong>
                        <textarea class="form-control @error('foto') is-invalid @enderror" name="deskripsi" id="deskripsi" cols="30" rows="10" >{{$project->deskripsi}}</textarea>
                        @error('deskripsi')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <strong>Status</strong>
                        <select class="form-select" name="status" id="status" required >
                            <option value="{{$project->status}}">{{$project->status}}</option>
                            @foreach($stattus as $status)
                            <option value="{{$status->jenis_s}}">{{$status->jenis_s}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <strong>Foto :</strong>
                        <input type="file" class="form-control  @error('foto') is-invalid @enderror" id="foto" name="foto" value="{{$project->foto}}">
                        @error('foto')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                    </div>

                     <div class="form-group">
                        <strong>Item :</strong>
                        <input type="text" class="form-control" id="item" name="item" placeholder="Nama Item" required value="{{$project->item}}">
                    </div>

                    <div class="form-group">
                        <strong>Tanggal Pengiriman :</strong>
                        <input type="date" class="form-control" id="tgl_pengiriman" name="tgl_pengiriman" required value="{{$project->tgl_pengiriman}}">
                    </div>

                    <div class="form-group">
                        <strong>Status</strong>
                        <select class="form-select" name="status1" id="status1" required>
                            <option  value="{{$project->status1}}">{{$project->status1}}</option>
                            <option value="Sudah Sampai">Sudah Sampai</option>
                            <option value="Belum Sampai">Belum Sampai</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <strong>Tanggal Kembali :</strong>
                        <input type="date" class="form-control" id="tgl_kembali" name="tgl_kembali" required value="{{$project->tgl_kembali}}">
                    </div>

                    <div class="form-group">
                        <strong>Status</strong>
                        <select class="form-select" name="status2" id="status2" required>
                            <option  value="{{$project->status2}}">{{$project->status2}}</option>
                            <option value="Sudah Sampai">Sudah Sampai</option>
                            <option value="Belum Sampai">Belum Sampai</option>
                        </select>
                    </div> 
<br>

<button type="submit" class="btn btn-primary">Simpan</button>
<a class="btn btn-danger" href="{{ route('project.index') }}">Back</a>


</form>


</div>


</div>

@endsection