<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
  /**
   * Display a listing of the resource.
   */


  // use Illuminate\Support\Facades\DB;

  public function index(Request $request)
  {
    $title = $request->input('title');
    $filter = $request->input('filter', '');
    $books = [];

    $queryBase = "SELECT books.*, AVG(reviews.rating) as reviews_avg_rating, COUNT(reviews.id) as reviews_count
                  FROM books
                  JOIN reviews ON books.id = reviews.book_id
                  WHERE 1=1";

    $bindings = [];

    if ($title) {
      $queryBase .= " AND books.title LIKE ?";
      $bindings[] = '%' . $title . '%';
    }

    switch ($filter) {
      case 'latest':
        $queryBase .= " ORDER BY books.created_at DESC LIMIT 10";
        $books = DB::select($queryBase, $bindings);
        break;

      case 'popular_last_month':
        $queryBase .= " AND reviews.created_at BETWEEN ? AND ?
                            GROUP BY books.id
                            HAVING reviews_count >= ?
                            ORDER BY reviews_count DESC, reviews_avg_rating DESC
                            LIMIT 10";
        $bindings[] = now()->subMonth();
        $bindings[] = now();
        $bindings[] = 2;
        $books = DB::select($queryBase, $bindings);
        break;

      case 'popular_last_6months':
        $queryBase .= " AND reviews.created_at BETWEEN ? AND ?
                            GROUP BY books.id
                            HAVING reviews_count >= ?
                            ORDER BY reviews_count DESC, reviews_avg_rating DESC
                            LIMIT 10";
        $bindings[] = now()->subMonths(6);
        $bindings[] = now();
        $bindings[] = 5;
        $books = DB::select($queryBase, $bindings);
        break;

      case 'highest_rated_last_month':
        $queryBase .= " AND reviews.created_at BETWEEN ? AND ?
                            GROUP BY books.id
                            HAVING reviews_count >= ?
                            ORDER BY reviews_avg_rating DESC, reviews_count DESC
                            LIMIT 10";
        $bindings[] = now()->subMonth();
        $bindings[] = now();
        $bindings[] = 2;
        $books = DB::select($queryBase, $bindings);
        break;

      case 'highest_rated_last_6months':
        $queryBase .= " AND reviews.created_at BETWEEN ? AND ?
                            GROUP BY books.id
                            HAVING reviews_count >= ?
                            ORDER BY reviews_avg_rating DESC, reviews_count DESC
                            LIMIT 10";
        $bindings[] = now()->subMonths(6);
        $bindings[] = now();
        $bindings[] = 6;
        $books = DB::select($queryBase, $bindings);
        break;

      default:
        $books = DB::select($queryBase, $bindings);
        break;
    }

    return view('books.index', ['books' => $books]);
  }




  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    //
  }

  /**
   * Display the specified resource.
   */
  public function show(int $id)
  {
    // Book::with();
    $cacheKey = 'book:' . $id;

    $book = cache()->remember(
      $cacheKey,
      3600,
      fn() => Book::with([
        'reviews' => fn($query) => $query->latest()
      ])->withAvgRating()->withReviewsCount()->findOrFail($id)
    );
    return view('books.show', ['book' => $book]);
  }


  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    //
  }
}
