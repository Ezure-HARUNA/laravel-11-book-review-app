<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Book;
use App\Models\Review;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Arr;

class DatabaseSeeder extends Seeder
{
  public function run(): void
  {
    // User::factory(10)->create();

    // User::factory()->create([
    //     'name' => 'Test User',
    //     'email' => 'test@example.com',
    // ]);

    // Mixed Reviews
    Book::factory(100)->create()->each(function ($book) {
      $numReviews = random_int(5, 30);
      for ($i = 0; $i < $numReviews; $i++) {
        Review::factory()->state(['rating' => Arr::random([
          1,
          2,
          3,
          4,
          5
        ])])->for($book)->create();
      }
    });
  }
}
