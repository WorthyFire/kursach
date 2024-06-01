<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Drink extends Model
{
    use HasFactory;

    protected $fillable = [
        'coffeeshop_id', 'name', 'ingredients', 'category', 'photo', 'description'
    ];

    public function coffeeshop()
    {
        return $this->belongsTo(Coffeeshop::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
