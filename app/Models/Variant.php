<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Variant extends Model
{
    use HasFactory;

    /**
     * Get all of the variant_value for the Variant
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function variant_value(): HasMany
    {
        return $this->hasMany(VariantValue::class);
    }
}
