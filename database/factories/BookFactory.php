<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as FakerFactory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
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
      'title' => $faker->realText(15), // $fakerを使用して、日本語のダミーデータを生成
      'author' => $faker->name,
      'created_at' => $faker->dateTimeBetween('-2 years', 'now'),
      'updated_at' => $faker->dateTimeBetween('createdAt', 'now'),
    ];
  }
}
