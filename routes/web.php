<?php

use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
  return view('index');
});

//MEMO: この1行を書くだけで、
//      booksページのCRUD処理の各ページのルート設定ができる。
Route::resource('books', BookController::class);
