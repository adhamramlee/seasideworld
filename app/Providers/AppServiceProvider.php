<?php

namespace App\Providers;

use App\Models\Inquiry;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
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
        View::composer('layouts.admin', function ($view) {
            $pendingCount = Cache::remember('pending_inquiries_count', 300, function () {
                return Inquiry::pending()->count();
            });
            $view->with('pendingInquiriesCount', $pendingCount);
        });
    }
}
