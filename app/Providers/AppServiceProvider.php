<?php

namespace App\Providers;

use App\Repositories\Contracts\ICategoryRepository;
use App\Repositories\Eloquent\CategoryRepository;
use App\Services\Contracts\ICategoryService;
use App\Services\Eloquent\CategoryService;
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
        $this->app->bind(ICategoryRepository::class, CategoryRepository::class);
        $this->app->bind(ICategoryService::class, CategoryService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
