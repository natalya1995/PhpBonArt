<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Creator extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'YY', 'biography', 'picture_id'
    ];

    public function pictures()
    {
        return $this->hasMany(Picture::class);
    }

    public function creatorPictures()
    {
        return $this->hasMany(CreatorPicture::class);
    }
}

