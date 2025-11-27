<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'quantity',
        'description',
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'product_tag', 'product_id', 'tag_id');
    }


    public function increaseQuantity(int $amount = 1)
    {
        $this->quantity += $amount;
        $this->save();
    }

    public function decreaseQuantity(int $amount = 1)
    {
        $this->quantity -= $amount;
        if ($this->quantity < 0) {
            $this->quantity = 0;
        }
        $this->save();
    }

}
