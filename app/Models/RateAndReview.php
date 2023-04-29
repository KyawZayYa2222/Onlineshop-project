<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RateAndReview extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'product_id',
        'star_count',
        'review',
        'user_id',
    ];
}
