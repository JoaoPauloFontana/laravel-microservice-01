<?php

namespace App\Providers;

use App\Models\{
    Category
};
use App\Observers\{
    CategoryObserver
};
use App\Repositories\{
    CategoryRepositoryInterface
};
use App\Repositories\Eloquent\{
    CategoryRepository
};
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
        $this->app->singleton(
            CategoryRepositoryInterface::class,
            CategoryRepository::class,
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Category::observe(CategoryObserver::class);
    }
}
