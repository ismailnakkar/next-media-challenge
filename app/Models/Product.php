<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $hidden = ['pivot'];

    public function categories() {
        return $this->belongsToMany(Category::class);
    }

    public function scopeInOrder($query, String $sortBy, String $sortingType) {
        return $query->orderBy($sortBy, $sortingType);
    }

}
