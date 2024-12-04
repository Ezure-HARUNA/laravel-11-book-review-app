<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
  use HasFactory;

  public function reviews()
  {
    return $this->hasMany(Review::class);
  }

  public function scopeWithAvgRating($query)
  {
    return $query->withAvg('reviews', 'rating');
  }

  public function scopeWithReviewsCount($query)
  {
    return $query->withCount('reviews');
  }
}
