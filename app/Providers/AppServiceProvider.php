<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind('path.public', function() {
            // Jika folder public_html ada, gunakan itu sebagai public path (untuk hosting)
            if (file_exists(base_path('public_html'))) {
                return base_path('public_html');
            }
            // Jika tidak, gunakan default (untuk Laragon/Lokal)
            return base_path('public');
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
