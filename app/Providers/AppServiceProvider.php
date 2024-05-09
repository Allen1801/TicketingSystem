<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\SentimentAnalysisService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(SentimentAnalysisService::class, function ($app) {
            return new SentimentAnalysisService();
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
