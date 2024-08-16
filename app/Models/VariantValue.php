<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class VariantValue extends Model
{
    use HasFactory;

    protected $fillable = ['variant_id', 'value'];

    /**
     * Get the variant that owns the VariantValue
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function variant(): BelongsTo
    {
        return $this->belongsTo(Variant::class);
    }

    /**
     * Get all of the product_detail for the VariantValue
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function product_detail(): HasMany
    {
        return $this->hasMany(ProductDetail::class);
    }
}
