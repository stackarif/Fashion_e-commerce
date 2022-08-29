<?php

namespace App\Providers;

use App\Models\BlogCategory;
use App\Models\Blogsetting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // if(config('app.env') === 'production') {
        //     \URL::forceScheme('https');
        // }

        $categories = BlogCategory::take(5)->get();
        View::share('categories', $categories);

        $setting = Blogsetting::first();
        View::share('setting', $setting);
    }
}
