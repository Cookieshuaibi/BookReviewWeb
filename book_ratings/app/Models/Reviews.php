<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reviews extends Model
{
    use HasFactory;
    protected $table = 'reviews';
    protected $fillable = ['book_id', 'user_id', 'rating', 'comment'];
    public function book()
    {
        return $this->belongsTo(Books::class, 'book_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
