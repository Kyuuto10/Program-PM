<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prioritas extends Model
{
    use HasFactory;
    protected $table = 'prioritas';
    protected $fillable = ['nama_prioritas','aktif'];
}
