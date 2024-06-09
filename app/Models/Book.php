<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'img', 'creator_id', 'description', 'num_pages', 'num_copy', 'estimate', 'location_id'
    ];

    public function creator()
    {
        return $this->belongsTo(Creator::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
