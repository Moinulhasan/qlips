<?php

namespace App\Providers;

use App\Models\CustomStatus;
use App\Models\Topic;
use App\Repository\status\StatusRepository;
use App\Repository\status\StatusRepositoryInterface;
use App\Repository\topic\TopicRepository;
use App\Repository\topic\TopicRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // status registration
        $this->app->singleton(StatusRepositoryInterface::class, function ($app) {
            return new StatusRepository(new CustomStatus());
        });

        //topic register
        $this->app->singleton(TopicRepositoryInterface::class, function ($app) {
            return new TopicRepository(new Topic(),
            resolve(StatusRepositoryInterface::class)
            );
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
