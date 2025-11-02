<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Artisan/CLI? Niets forceren, voorkomt "Invalid URI" bij route:list etc.
        if ($this->app->runningInConsole()) {
            return;
        }

        // Alleen forceren als er een geldige APP_URL staat
        $root = config('app.url'); // komt uit APP_URL

        if (is_string($root) && preg_match('#^https?://#i', $root)) {
            URL::forceRootUrl($root);

            // Indien je site via HTTPS draait (Herd/Valet), forceer https
            if (str_starts_with($root, 'https://')) {
                URL::forceScheme('https');
            }
        }
    }
}
