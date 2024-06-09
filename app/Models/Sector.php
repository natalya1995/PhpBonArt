<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    use HasFactory;

    protected $fillable = [
        'num', 'picture_id'
    ];

    public function pictures()
    {
        return $this->hasMany(Picture::class);
    }
}
