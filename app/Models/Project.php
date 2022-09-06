<?php

namespace App\Models;

use App\Helper\Imageable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Project extends Model
{
    use HasFactory;
    use Sortable;

    protected $table = 'project_detail';
    protected $fillable = ['tanggal','nama_instansi','nama_lokasi','nama_teknisi','produk','warranty',
                            'priority','jobdesk','deskripsi','status','deskripsi','status','image','item','tgl_pengiriman','status1',
                            'tgl_kembali','status2','comment'];


    public $sortable = [
        'tanggal',
        'nama_instansi',
        'nama_lokasi',
        'nama_teknisi',
        'produk',
        'warranty'
    ];

    // public function foto()
    // {
    //     return $this->hasMany(Foto::class, 'foreign_key','local_key');
    // }
}

