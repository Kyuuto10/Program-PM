<?php

namespace App\Models;

use App\Models\Data;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function data(){
        return $this->belongsTo(Data::class);
    }
}
