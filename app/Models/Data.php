<?php

namespace App\Models;

use App\Models\Image;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    use HasFactory;

    protected $table = 'data';
    protected $fillable = ['tanggal','nama_instansi','nama_lokasi','id_teknisi','id_produk','warranty',
                            'id_prioritas','id_jobdesk','deskripsi','id_status','deskripsi','status','item','tgl_pengiriman','status_pengiriman',
                            'tgl_kembali','status_kembali','comment','id_user','date_modified'];


    public function images(){
        return $this->hasMany(Image::class);
    }
}

