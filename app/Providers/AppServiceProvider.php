<?php

namespace App\Providers;

use App\Services\AllCategories;
use App\Services\AllProductsService;
use App\Services\BoutiqueService;
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

        $allBoutiques = new BoutiqueService();
        $allBoutiques = $allBoutiques->getAllBoutiques();

        View::composer('*', function ($view) use ($allBoutiques) {
            $view->with('allBoutiques', $allBoutiques);
        });

        $allProducts = new AllProductsService();
        $allProducts = $allProducts->getAllProducts();

        View::composer('*', function ($view) use ($allProducts) {
            $view->with('allProducts', $allProducts);
        });




        Builder::defaultStringLength(191);
    }
}
