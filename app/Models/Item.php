<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        "title",
        "category_id",
        "user_id",
        "image",
        "is_complete",
        "description"
    ];

    public function category(){
        return $this->belongsTo("App\Models\Category");
    }
}
