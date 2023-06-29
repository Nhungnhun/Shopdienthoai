<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $table = 'ratings';

    protected $fillable = [
        'user_id',
        'product_id',
        'stars_rated',
    ];

    public function rating() {
        $this->belongsTo(Review::class, 'user_id', 'user_id');
    }
}
