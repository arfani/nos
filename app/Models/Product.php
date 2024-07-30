<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['name', 'slug', 'stock', 'price'];

    public function product_variant(): HasMany
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function product_pictures(): HasMany
    {
        return $this->hasMany(ProductPicture::class);
    }

    public function category(): BelongsToMany
    {
        return $this->belongsToMany(Category::class)->withTimestamps();
    }

    public function promo(): HasOne
    {
        return $this->hasOne(Promo::class);
    }

    public function dimention(): HasOne
    {
        return $this->hasOne(Dimention::class);
    }
    
    public function detail_value(): HasMany
    {
        return $this->hasMany(DetailValue::class);
    }
    
    // LELANG
    public function auction(): HasOne
    {
        return $this->hasOne(Auction::class);
    }
}
