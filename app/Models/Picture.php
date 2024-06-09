<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'img', 'creator_id', 'size', 'description', 'janre_id', 'location_id', 'sector_id', 'committent_id', 'estimate'
    ];

    public function creator()
    {
        return $this->belongsTo(Creator::class);
    }

    public function janre()
    {
        return $this->belongsTo(Janre::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function sector()
    {
        return $this->belongsTo(Sector::class);
    }

    public function committent()
    {
        return $this->belongsTo(Committent::class);
    }

    public function bids()
    {
        return $this->hasMany(Bid::class);
    }

    public function pictureJanres()
    {
        return $this->hasMany(PictureJanre::class);
    }

    public function creatorPictures()
    {
        return $this->hasMany(CreatorPicture::class);
    }
}
