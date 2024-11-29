<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as FakerFactory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {
    $faker = FakerFactory::create('ja_JP');
    return [
      'book_id' => null,
      'review' => $this->randomLengthReview($faker),
      'rating' => $faker->numberBetween(1, 5),
      'created_at' => $faker->dateTimeBetween('-2 years', 'now'),
      'updated_at' => $faker->dateTimeBetween('createdAt', 'now'),

    ];
  }

  protected function randomLengthReview($faker): string
  {
    $length = random_int(30, 200);
    return $faker->realText($length);
  }
  public function good()
  {
    $faker = FakerFactory::create('ja_JP');
    return $this->state(function (array $attributes) {
      return [
        'rating' => fake()->numberBetween(4, 5)
      ];
    });
  }

  public function average()
  {
    $faker = FakerFactory::create('ja_JP');
    return $this->state(function (array $attributes) {
      return [
        'rating' => fake()->numberBetween(2, 5)
      ];
    });
  }
  public function bad()
  {
    $faker = FakerFactory::create('ja_JP');
    return $this->state(function (array $attributes) {
      return [
        'rating' => fake()->numberBetween(1, 3)
      ];
    });
  }
}
