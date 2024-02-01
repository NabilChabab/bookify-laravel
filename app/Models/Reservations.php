<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservations extends Model
{
    use HasFactory;


    protected $fillable = [
      'description',
      'return_date',
      'is_returned',
      'user_id',
      'book_id'  
    ];
    protected static function booted()
    {
      static::created(function (Reservations $reservation){
        
            $book = $reservation->book;

            if ($book->available_copies > 0) {
                $book->decrement('available_copies');
                $book->save();
                session()->flash('success', 'Reservation successful!');
                session()->flash('delay', 2000);
            } else {
                session()->flash('error', 'Sorry, there are no available copies for this book!');
                session()->flash('delay', 2000);
            }
      });

      static::retrieved(function ($reservation) {
        if (now()->greaterThan($reservation->return_date)) {
            $reservation->delete();
            
        }
    });
    }

    public function book()
{
    return $this->belongsTo(Books::class);
}

public function user()
{
    return $this->belongsTo(User::class);
}
}
