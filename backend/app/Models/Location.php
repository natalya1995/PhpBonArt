<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'picture_id'
    ];

    public function pictures()
    {
        return $this->hasMany(Picture::class);
    }

    public function jewerlies()
    {
        return $this->hasMany(Jewerly::class);
    }
}
