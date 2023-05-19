<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'url', 'categorie_id'];

    public $timestamps = false;

    public function categories()
    {
        return $this->belongsTo(Categorie::class);
    }
}
