<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        "title",
        "category_id",
        "user_id",
        "title",
        "image",
        "is_complete",
        "description"
    ];
}
