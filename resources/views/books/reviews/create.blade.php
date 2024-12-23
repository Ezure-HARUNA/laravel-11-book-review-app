@extends('layouts.app')

@section('content')
  <h1 class="mb-10 text-2xl">Add Review for {{ $book->title }}</h1>
  <form action="{{ route('books.reviews.store', $book) }}" method="POST">
    @csrf
    <label for="review">レビュー</label>
    <textarea name="review" id="review" required class="input mb-4"></textarea>
    <label for="評価"></label>
    <select name="rating" id="rating" class="input mb-4" required>
      <option value="">評価を選択する</option>
      @for ($i = 1; $i <= 5; $i++)
        <option value="{{ $i }}">{{ $i }}</option>
      @endfor
    </select>
    <button type="submit" class="btn">レビューを追加する</button>
  </form>
@endsection
