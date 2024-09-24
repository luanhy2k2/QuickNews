<?php

namespace App\Providers;

use App\Repositories\Contracts\IArticleFileRepository;
use App\Repositories\Contracts\IArticleRepository;
use App\Repositories\Contracts\IArticleTagRepository;
use App\Repositories\Contracts\ICategoryRepository;
use App\Repositories\Contracts\ICommentRepository;
use App\Repositories\Contracts\ITagRepository;
use App\Repositories\Contracts\IUserRepository;
use App\Repositories\Eloquent\ArticleFileRepository;
use App\Repositories\Eloquent\ArticleRepository;
use App\Repositories\Eloquent\ArticleTagRepository;
use App\Repositories\Eloquent\CategoryRepository;
use App\Repositories\Eloquent\CommentRepository;
use App\Repositories\Eloquent\TagRepository;
use App\Repositories\Eloquent\UserRepository;
use App\Services\Contracts\IArticleFileService;
use App\Services\Contracts\IArticleService;
use App\Services\Contracts\IArticleTagService;
use App\Services\Contracts\ICategoryService;
use App\Services\Contracts\ICommentService;
use App\Services\Contracts\ITagService;
use App\Services\Contracts\IUserService;
use App\Services\Eloquent\ArticleFileService;
use App\Services\Eloquent\ArticleService;
use App\Services\Eloquent\ArticleTagService;
use App\Services\Eloquent\CategoryService;
use App\Services\Eloquent\CommentService;
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
        //Register for tag service
        $this->app->bind(ITagRepository::class, TagRepository::class);
        $this->app->bind(ITagService::class, TagService::class);
        //Register for article service
        $this->app->bind(IArticleRepository::class, ArticleRepository::class);
        $this->app->bind(IArticleService::class, ArticleService::class);
        //Register for articleTag service
        $this->app->bind(IArticleTagRepository::class, ArticleTagRepository::class);
        $this->app->bind(IArticleTagService::class, ArticleTagService::class);
        //Register for article file service
        $this->app->bind(IArticleFileRepository::class, ArticleFileRepository::class);
        $this->app->bind(IArticleFileService::class, ArticleFileService::class);
        //Register for comment service
        $this->app->bind(ICommentRepository::class, CommentRepository::class);
        $this->app->bind(ICommentService::class, CommentService::class);
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
