@extends('layout.master')
@section('content')


<div class="col-lg-12 margin-tb">
            <div>
                <h2>Show</h2>
            </div>
            



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
                <li class="list-group-item"><b>Foto :&ensp;</b><img src="{{asset('storage/', $project->foto)}}">{{$project->foto}}</li>
                </div>
                <li class="list-group-item"><b>Item :&ensp;</b>{{$project->item}}</li>
                <li class="list-group-item"><b>Tanggal Pengiriman :&ensp;</b>{{$project->tgl_pengiriman}}</li>
                <li class="list-group-item"><b>Status :&ensp;</b>{{$project->status1}}</li>
                <li class="list-group-item"><b>Tanggal Kembali :&ensp;</b>{{$project->tgl_kembali}}</li>
                <li class="list-group-item"><b>Status :&ensp;</b>{{$project->status2}}</li>
            </ul>
            <br>

            <a href="{{route('project.index')}}" class="btn btn-primary">Back</a>
    </div>
<br>

    <!-- <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Tanggal:</strong>
                {{ $project->tanggal }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nama Instansi:</strong>
                {{ $project->nama_instansi }}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nama Lokasi:</strong>
                {{ $project->nama_lokasi }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Teknisi:</strong>
                {{ $project->nama_teknisi }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Produk:</strong>
                {{ $project->produk }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Warranty:</strong>
                {{ $project->warranty }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Priority:</strong>
                {{ $project->priority }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Jobdesk:</strong>
                {{ $project->jobdesk }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Deskripsi:</strong>
                {{ $project->deskripsi }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Status:</strong>
                {{ $project->status }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Foto:</strong>
                <img src="{{asset('storage/', $project->foto)}}" alt="">
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Item:</strong>
                {{ $project->item }}
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Tgl Pengiriman:</strong>
                {{ $project->tgl_pengiriman }}
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Status:</strong>
                {{ $project->status1 }}
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Tgl Kembali:</strong>
                {{ $project->tgl_kembali }}
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Status:</strong>
                {{ $project->status2 }}
            </div>
            <br>
            
            <a href="{{route('project.index')}}" class="btn btn-primary">Back</a> -->

    @endsection