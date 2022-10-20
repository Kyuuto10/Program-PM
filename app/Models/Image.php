<?php

namespace App\Models;

use App\Models\Data;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function data(){
        return $this->belongsTo(Data::class);
    }

    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }
}
