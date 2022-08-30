<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    use HasFactory;

    protected $casts = ['fotos' => 'array'];
    protected $fillable = [
        'foto'
    ];

    public function project_detail(){
        return $this->belongsTo(App\Models\Project::class, 'foreign_key','local_key');
    }
}
