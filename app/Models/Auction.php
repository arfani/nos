<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Auction extends Model
{
    use HasFactory;

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
    
    public function the_winner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'winner');
    }

    public function bids(): HasMany
    {
        return $this->hasMany(Bid::class)->orderBy('value', 'desc');
    }
    
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class)->latest();
    }
}
