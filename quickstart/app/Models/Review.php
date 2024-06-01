<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'coffeeshop_id', 'drink_id', 'rating', 'comment'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function coffeeshop()
    {
        return $this->belongsTo(Coffeeshop::class);
    }

    public function drink()
    {
        return $this->belongsTo(Drink::class);
    }
}
