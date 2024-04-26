<?php

namespace App\Providers;

use App\Domain\Repositories\MessageEntityRepositoryInterface;
use App\Domain\Repositories\NewsletterEntityRepositoryInterface;
use App\Domain\Repositories\UserEntityRepositoryInterface;
use App\Repositories\Eloquent\MessageEloquentRepository;
use App\Repositories\Eloquent\NewsLetterEloquentRepository;
use App\Repositories\Eloquent\UserEloquentRepository;
use App\Services\RabbitMQ\AMQPService;
use App\Services\RabbitMQ\RabbitInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserEntityRepositoryInterface::class, UserEloquentRepository::class);
        $this->app->bind(NewsletterEntityRepositoryInterface::class,NewsLetterEloquentRepository::class);
        $this->app->bind(MessageEntityRepositoryInterface::class, MessageEloquentRepository::class);
        $this->app->bind(RabbitInterface::class, AMQPService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
