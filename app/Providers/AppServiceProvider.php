<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;

class RouteServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   */
  public function register(): void
  {
    //
  }

  /**
   * Bootstrap any application services.
   */
  public function boot(): void
  {
    $this->configureRateLimiting();

    $this->routes(function () {
      Route::prefix('api')
        ->middleware('api')
        ->namespace($this->namespace)
        ->group(base_path('routes/api.php'));

      Route::middleware('web')
        ->namespace($this->namespace)
        ->group(base_path('routes/web.php'));
    });
  }

  /**
   * Configure the rate limiting for the application.
   *
   * @return void
   */
  protected function configureRateLimiting(): void
  {
    RateLimiter::for('books', function ($request) {
      return Limit::perMinute(10)->by($request->ip());
    });

    RateLimiter::for('reviews', function ($request) {
      return Limit::perMinute(10)->by($request->ip());
    });
  }
}
