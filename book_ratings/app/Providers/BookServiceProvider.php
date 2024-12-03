<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\BookService;

class BookServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

        $this->app->singleton('bookService', function ($app) {
            return new BookService();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
