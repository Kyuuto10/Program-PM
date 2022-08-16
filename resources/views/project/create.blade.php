@extends('layout.master')
@section('content')

<div class="container">
    <div class="jumbotron">
    <h1 class="display-6">Tambah Data</h1> <br>
            <form action="{{ route('project.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                    <div class="form-group">
                        <strong>Nama Instansi :</strong>
                        <input type="text" class="form-control" id="nama_instansi" name="nama_instansi" placeholder="Nama Instansi" autocomplete="off" required value="{{old('nama_instansi')}}">
                    </div>

                    <div class="form-group">
                        <strong>Nama Lokasi :</strong>
                        <input type="text" class="form-control" id="nama_lokasi" name="nama_lokasi" placeholder="Nama Lokasi" autocomplete="off" required value="{{old('nama_lokasi')}}">
                    </div>

                    <div class="form-group">
                       <strong>Teknisi</strong>
                        <select class="form-select" name="nama_teknisi" id="nama_teknisi" required value="{{old('nama_teknisi')}}">
                            <option disabled selected option>--Pilih--</option>
                            @foreach($teknisis as $teknisi)
                            <option value="{{$teknisi->nama_teknisi}}">{{$teknisi->nama_teknisi}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <strong>Produk</strong>
                       <select class="form-select" name="produk" id="produk" required value="{{old('produk')}}">
                        <option disabled selected option>--Pilih--</option>
                        @foreach($product as $produk)
                        <option value="{{$produk->nama_produk}}">{{$produk->nama_produk}}</option>
                        @endforeach
                       </select>
                    </div>

                    <div class="form-group">
                        <strong>Warranty</strong>
                        <select class="form-select" name="warranty" id="warranty" required value="{{old('warranty')}}">
                            <option disabled selected option>--Pilih--</option>
                            <option value="Garansi">Garansi</option>
                            <option value="Non - Garansi">Non - Garansi</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <strong>Priority</strong>
                        <select class="form-select" name="priority" id="priority" required value="{{old('priority')}}">
                            <option disabled selected option>--Pilih--</option>
                            @foreach($priorittas as $prioritas)
                            <option value="{{$prioritas->jenis_prioritas}}">{{$prioritas->jenis_prioritas}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <strong>Jobdesk</strong>
                        <select class="form-select" name="jobdesk" id="jobdesk" required value="{{old('jobdesk')}}">
                            <option disabled selected option>--Pilih--</option>
                            @foreach($jobdesks as $jobdesk)
                            <option value="{{$jobdesk->jenis_j}}">{{$jobdesk->jenis_j}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <strong>Deskripsi :</strong>
                        <textarea class="form-control" name="deskripsi" id="deskripsi" cols="30" rows="10" value="{{old('deskripsi')}}"></textarea>
                    </div>

                    <div class="form-group">
                        <strong>Status</strong>
                        <select class="form-select" name="status" id="status" required value="{{old('status')}}">
                            <option disabled selected option>--Pilih--</option>
                            @foreach($stattus as $status)
                            <option value="{{$status->jenis_s}}">{{$status->jenis_s}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <strong>Foto :</strong>
                        <input type="file" class="form-control  @error('foto') is-invalid @enderror" id="foto" name="foto">
                        @error('foto')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                    </div>

                     <div class="form-group">
                        <strong>Item :</strong>
                        <input type="text" class="form-control" id="item" name="item" placeholder="Nama Item" required value="{{old('item')}}">
                    </div>

                    <div class="form-group">
                        <strong>Tanggal Pengiriman :</strong>
                        <input type="date" class="form-control" id="tgl_pengiriman" name="tgl_pengiriman" required value="{{old('tgl_pengiriman')}}">
                    </div>

                    <div class="form-group">
                        <strong>Status</strong>
                        <select class="form-select" name="status1" id="status1" required value="{{old('status1')}}">
                            <option disabled selected option>--Pilih--</option>
                            <option value="Sudah Sampai">Sudah Sampai</option>
                            <option value="Belum Sampai">Belum Sampai</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <strong>Tanggal Kembali :</strong>
                        <input type="date" class="form-control" id="tgl_kembali" name="tgl_kembali" required value="{{old('tgl_kembali')}}">
                    </div>

                    <div class="form-group">
                        <strong>Status</strong>
                        <select class="form-select" name="status2" id="status2" required value="{{old('status2')}}">
                            <option disabled selected option>--Pilih--</option>
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