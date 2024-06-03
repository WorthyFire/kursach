<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coffeeshop extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'contact',
        'photo',
        'description'
    ];

    public function drinks()
    {
        return $this->hasMany(Drink::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
