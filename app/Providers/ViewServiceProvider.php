<?php

namespace App\Providers;

use App\Models\Placetype;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
            // تمرير أنواع الأماكن إلى الفوتر بشكل تلقائي
        View::composer('layouts.frontend.inc.footer', function ($view) {
            // نحاول جلبها من الكاش أولاً
            $placetypes = Cache::remember('placetypes', now()->addMinutes(60), function () {
                return Placetype::all();
            });

            // نمررها إلى الفيو
            $view->with('placetypes', $placetypes);
        });
    }
}
