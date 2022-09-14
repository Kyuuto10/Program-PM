<?php

namespace App\Models;

use App\Helper\Imageable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Data extends Model
{
    use HasFactory;
    use Sortable;

    protected $table = 'data';
    protected $fillable = ['tanggal','nama_instansi','nama_lokasi','id_teknisi','id_produk','warranty',
                            'id_prioritas','id_jobdesk','deskripsi','id_status','deskripsi','status','image','item','tgl_pengiriman','status_pengiriman',
                            'tgl_kembali','status_kembali','comment','id_user','date_modified'];


    public $sortable = [
        'tanggal',
        'nama_instansi',
        'nama_lokasi',
        'id_teknisi',
        'id_produk',
        'id_warranty'
    ];
}

