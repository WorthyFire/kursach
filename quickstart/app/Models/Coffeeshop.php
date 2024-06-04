<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coffeeshop extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'address', 'contact', 'photo', 'description'
    ];

    protected $appends = ['average_rating'];

    public function drinks()
    {
        return $this->hasMany(Drink::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function getAverageRatingAttribute()
    {
        $averageRating = $this->reviews()->avg('rating');
        return $averageRating ? $averageRating : 'Рейтинг отсутствует';
    }
}
