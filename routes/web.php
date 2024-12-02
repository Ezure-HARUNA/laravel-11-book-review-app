<?php

use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
  return redirect()->route('books.index');
});

//MEMO: この1行を書くだけで、
//      booksページのCRUD処理の各ページのルート設定ができる。
//      →リソースコントローラと呼ぶ
Route::resource('books', BookController::class);
