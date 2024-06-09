<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PictureJanre extends Model
{
    use HasFactory;

    protected $fillable = [
        'picture_id', 'janre_id'
    ];

    public function picture()
    {
        return $this->belongsTo(Picture::class);
    }

    public function janre()
    {
        return $this->belongsTo(Janre::class);
    }
}

