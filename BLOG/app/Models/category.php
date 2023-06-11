<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    use HasFactory;

    public $fillable = ['name'];

    public function articles()
    {
        return $this->belongsToMany(Article::class);
    }
}
