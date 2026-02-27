<?php

namespace App\Providers;

use App\Services\RakutenTravelService;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class RakutenTravelServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(RakutenTravelService::class, function () {
            return new RakutenTravelService(
                Log::channel('rakuten_travel'),
            );
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Http::macro('rakutenTravel', function () {
            return Http::baseUrl(config('services.rakuten_travel.base_url'));
        });
    }
}
