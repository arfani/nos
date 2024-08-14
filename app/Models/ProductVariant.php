<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ProductVariant extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'stock',
        'price',
        'weight',
        'sku',
        'active',
    ];

    public function product_detail(): HasMany
    {
        return $this->hasMany(ProductDetail::class);
    }
}
