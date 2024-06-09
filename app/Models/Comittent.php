<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Committent extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'IIN', 'num_udv', 'picture_id', 'entry_price'
    ];

    public function pictures()
    {
        return $this->hasMany(Picture::class);
    }
}

