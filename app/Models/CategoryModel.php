<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryModel extends Model
{
    use HasFactory;

    // function category
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
