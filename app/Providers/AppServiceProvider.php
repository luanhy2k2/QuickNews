<?php

namespace App\Providers;

use App\Repositories\Contracts\IArticleFileRepository;
use App\Repositories\Contracts\IArticleTagRepository;
use App\Repositories\Contracts\ICategoryRepository;
use App\Repositories\Contracts\ITagRepository;
use App\Repositories\Contracts\IUserRepository;
use App\Repositories\Eloquent\ArticleFileRepository;
use App\Repositories\Eloquent\ArticleTagRepository;
use App\Repositories\Eloquent\CategoryRepository;
use App\Repositories\Eloquent\TagRepository;
use App\Repositories\Eloquent\UserRepository;
use App\Services\Contracts\IArticleFileService;
use App\Services\Contracts\IArticleTagService;
use App\Services\Contracts\ICategoryService;
use App\Services\Contracts\ITagService;
use App\Services\Contracts\IUserService;
use App\Services\Eloquent\ArticleFileService;
use App\Services\Eloquent\ArticleTagService;
use App\Services\Eloquent\CategoryService;
use App\Services\Eloquent\TagService;
use App\Services\Eloquent\UserService;
use Illuminate\Cache\TagSet;
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
        //Register for category service
        $this->app->bind(ICategoryRepository::class, CategoryRepository::class);
        $this->app->bind(ICategoryService::class, CategoryService::class);
        //Register for user service
        $this->app->bind(IUserRepository::class, UserRepository::class);
        $this->app->bind(IUserService::class, UserService::class);
        //Register for category service
        $this->app->bind(ITagRepository::class, TagRepository::class);
        $this->app->bind(ITagService::class, TagService::class);
        //Register for articleTag service
        $this->app->bind(IArticleTagRepository::class, ArticleTagRepository::class);
        $this->app->bind(IArticleTagService::class, ArticleTagService::class);
        //Register for article file service
        $this->app->bind(IArticleFileRepository::class, ArticleFileRepository::class);
        $this->app->bind(IArticleFileService::class, ArticleFileService::class);
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
