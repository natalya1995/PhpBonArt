<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'picture_id', 'price', 'bids_id', 'order_id', 'Purchase_type'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function picture()
    {
        return $this->belongsTo(Picture::class);
    }

    public function bid()
    {
        return $this->belongsTo(Bid::class);
    }
}
