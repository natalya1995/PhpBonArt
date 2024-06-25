<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreatorPicture extends Model
{
    use HasFactory;

    protected $fillable = [
        'picture_id', 'creator_id'
    ];

    public function picture()
    {
        return $this->belongsTo(Picture::class);
    }

    public function creator()
    {
        return $this->belongsTo(Creator::class);
    }
}
