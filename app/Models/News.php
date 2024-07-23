<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'title', 'date', 'category'];

    public function getImageAttribute($value)
    {
        return json_decode($value, true);
    }
}
