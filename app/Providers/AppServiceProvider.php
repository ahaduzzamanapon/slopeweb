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
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        \Illuminate\Support\Facades\View::composer('admin.layouts.sidebar', function ($view) {
            $view->with('menus', \App\Models\Menu::whereNull('parent_id')->with('children')->orderBy('order')->get());
        });

        // Share data with all frontend views
        \Illuminate\Support\Facades\View::composer('frontend.*', function ($view) {
            $view->with('globalCategories', \App\Models\Category::where('active', true)->orderBy('order')->get());
            $view->with('globalSettings', \App\Models\GeneralSetting::first() ?? new \App\Models\GeneralSetting());
        });
    }
}
