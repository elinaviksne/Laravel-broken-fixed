<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ["name"];

    public function products(){
        return $this->belongsToMany(Product::class, 'products_tag', 'tag_id', 'products_id');
    }
}
