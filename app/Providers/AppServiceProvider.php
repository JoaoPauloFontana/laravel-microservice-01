<?php

namespace App\Providers;

use App\Models\{
    Category,
    Company
};
use App\Observers\{
    CategoryObserver,
    CompanyObserver
};
use App\Repositories\{
    CategoryRepositoryInterface,
    CompanyRepositoryInterface
};
use App\Repositories\Eloquent\{
    CategoryRepository,
    CompanyRepository
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

        $this->app->singleton(
            CompanyRepositoryInterface::class,
            CompanyRepository::class,
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
        Company::observe(CompanyObserver::class);
    }
}
