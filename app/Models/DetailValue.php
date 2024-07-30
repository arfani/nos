<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetailValue extends Model
{
    use HasFactory;

    /**
     * Get the detail that owns the DetailValue
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function detail(): BelongsTo
    {
        return $this->belongsTo(Detail::class);
    }
}
