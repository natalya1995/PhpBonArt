<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auction extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'start_time', 'end_time'
    ];

    public function bids()
    {
        return $this->hasMany(Bid::class);
    }

    public function items()
    {
        return $this->hasMany(Item::class); // связь с лотами
    }
}
