<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'author', 'genre', 'description', 'publication_Year', 'total_copies', 'available_copies', 'cover'
    ];

}    
