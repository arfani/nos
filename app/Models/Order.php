<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;
    
    public function order_address(): BelongsTo
    {
        return $this->belongsTo(OrderAddress::class);
    }
    
    public function shipping_method(): BelongsTo
    {
        return $this->belongsTo(ShippingMethod::class);
    }

    public function delivery_state(): BelongsTo
    {
        return $this->belongsTo(DeliveryState::class);
    }

    public function order_detail(): HasMany
    {
        return $this->hasMany(OrderDetail::class);
    }

    // MEMBER
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
}
