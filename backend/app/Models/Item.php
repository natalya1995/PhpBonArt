<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'auction_id', 'name', 'description', 'starting_price', 'current_price', 'winning_bid_id', 'picture_id', 'book_id', 'jewerly_id'
    ];

    public function auction()
    {
        return $this->belongsTo(Auction::class);
    }

    public function bids()
    {
        return $this->hasMany(Bid::class);
    }

    public function winningBid()
    {
        return $this->belongsTo(Bid::class, 'winning_bid_id');
    }

   
    public function picture()
    {
        return $this->belongsTo(Picture::class, 'picture_id');
    }

    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }

    public function jewerly()
    {
        return $this->belongsTo(Jewerly::class, 'jewerly_id');
    }
    public function updateWinningBid()
    {
        // Получаем ставку с самой высокой ценой
        $winningBid = $this->bids()->orderBy('bin_amount', 'desc')->first();

        if ($winningBid) {
            // Обновляем текущую цену и идентификатор победившей ставки
            $this->current_price = $winningBid->bin_amount;
            $this->winning_bid_id = $winningBid->id;
            $this->save();
        }
    }
}
