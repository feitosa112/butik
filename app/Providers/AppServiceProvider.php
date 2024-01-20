<?php

namespace App\Providers;

use App\Services\AllCategories;
use App\Services\CategoriesService;
use Illuminate\Database\Schema\Builder;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // $this->app->singleton(AllCategories::class, function ($app) {
        //     return new AllCategories();
        // });

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $allCategories = new CategoriesService();
        $allCategories = $allCategories->getAllcategories();

        View::composer('*', function ($view) use ($allCategories) {
            $view->with('allCategories', $allCategories);
        });




        Builder::defaultStringLength(191);
    }
}
