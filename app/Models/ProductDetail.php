<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_variant_id',
        'variant_value_id',
        'is_main'
    ];

    /**
     * Get the variant_value that owns the ProductDetail
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function variant_value(): BelongsTo
    {
        return $this->belongsTo(VariantValue::class);
    }
}
