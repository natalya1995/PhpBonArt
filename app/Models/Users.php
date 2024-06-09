<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'phone', 'email', 'bit_id'
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function bids()
    {
        return $this->hasMany(Bid::class);
    }
}
