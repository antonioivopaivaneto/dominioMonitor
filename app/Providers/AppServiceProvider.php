<?php

namespace App\Providers;

use App\Interface\WhoisServiceInterface;
use App\Services\Message;
use App\Services\TwilioService;
use App\Services\WhoisService;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(WhoisServiceInterface::class,WhoisService::class);
        $this->app->bind(Message::class,TwilioService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Vite::prefetch(concurrency: 3);
    }
}
