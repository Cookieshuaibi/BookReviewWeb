<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'author','summary', 'year', 'genre', 'description','average_rating','image_url','publisher','language','isbn'];
    public function reeviews()
    {
        return $this->hasMany(Reviews::class);
    }
}
