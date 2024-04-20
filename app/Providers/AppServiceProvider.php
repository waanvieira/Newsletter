<?php

namespace App\Providers;

use App\Domain\Repositories\MessageEntityRepositoryInterface;
use App\Domain\Repositories\NewsletterEntityRepositoryInterface;
use App\Domain\Repositories\UserEntityRepositoryInterface;
use App\Repositories\Eloquent\MessageEloquentRepository;
use App\Repositories\Eloquent\NewLetterEloquentRepository;
use App\Repositories\Eloquent\UserEloquentRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserEntityRepositoryInterface::class, UserEloquentRepository::class);
        $this->app->bind(NewsletterEntityRepositoryInterface::class, NewLetterEloquentRepository::class);
        $this->app->bind(MessageEntityRepositoryInterface::class, MessageEloquentRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
