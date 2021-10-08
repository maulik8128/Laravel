<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductStock extends Model
{
    use HasFactory;
    public $fillable = ['opening_stock','product_id'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
