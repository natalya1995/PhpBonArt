<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jewerly extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'img', 'description', 'estimate', 'location_id'
    ];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
