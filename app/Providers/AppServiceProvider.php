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
        $this->app->bind('App\Helpers\Http\Contracts\ClientInterface', 'App\Helpers\Http\Clients\Guzzle');
     
        // Services
        $this->app->bind('App\Services\Contracts\IDataAggregationService', 'App\Services\DataAggregationService');

        //Repositories
        $this->app->bind('App\Repositories\Contracts\IArticleRepository', 'App\Repositories\ArticleRepository');
        $this->app->bind('App\Repositories\Contracts\IAuthorRepository', 'App\Repositories\AuthorRepository');
        $this->app->bind('App\Repositories\Contracts\ICategoryRepository', 'App\Repositories\CategoryRepository');
        $this->app->bind('App\Repositories\Contracts\ISourceRepository', 'App\Repositories\SourceRepository');
        $this->app->bind('App\Repositories\Contracts\IUserPreferencesRepository', 'App\Repositories\UserPreferencesRepository');
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
