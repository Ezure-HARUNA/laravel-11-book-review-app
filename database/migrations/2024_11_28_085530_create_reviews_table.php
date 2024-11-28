<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('reviews', function (Blueprint $table) {
      $table->id();
      // MEMO: Bookテーブルと紐づけるためのID？
      $table->text('review');
      $table->unsignedTinyInteger('rating');
      $table->timestamps();
      // $table->unsignedBigInteger('book_id');
      // $table->foreign('book_id')->references('id')->on('books')
      //   ->onDelete('cascade');
      //MEMO: ↑の2行でも同じ意味の実装ができる
      $table->foreignId('book_id')->constrained()->cascadeOnDelete();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('reviews');
  }
};
