<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'color'];

    public $timestamps = false;

    public function videos()
    {
        return $this->hasMany(Video::class);
    }
}
