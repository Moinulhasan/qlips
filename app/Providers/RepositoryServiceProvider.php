<?php

namespace App\Providers;

use App\Models\Advisor;
use App\Models\CustomStatus;
use App\Models\Qlips;
use App\Models\Question;
use App\Models\Topic;
use App\Models\User;
use App\Repository\advisor\AdvisorRepository;
use App\Repository\advisor\AdvisorRepositoryInterface;
use App\Repository\clips\ClipsRepository;
use App\Repository\clips\ClipsRepositoryInterface;
use App\Repository\question\QuestionRepository;
use App\Repository\question\QuestionRepositoryInterface;
use App\Repository\status\StatusRepository;
use App\Repository\status\StatusRepositoryInterface;
use App\Repository\topic\TopicRepository;
use App\Repository\topic\TopicRepositoryInterface;
use App\Repository\user\UserRepository;
use App\Repository\user\UserRepositoryInterface;
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

        // question register
        $this->app->singleton(QuestionRepositoryInterface::class,function ($app){
            return new QuestionRepository(new Question(),
            resolve(StatusRepositoryInterface::class)
            );
        });

        // user register
        $this->app->singleton(UserRepositoryInterface::class,function ($app){
            return new UserRepository(new User());
        });

        // advisor register
        $this->app->singleton(AdvisorRepositoryInterface::class,function ($app){
            return new AdvisorRepository(new Advisor(),
            resolve(StatusRepositoryInterface::class));
        });

        //clips register
        $this->app->singleton(ClipsRepositoryInterface::class,function ($app){
            return new ClipsRepository(new Qlips(),
            resolve(QuestionRepositoryInterface::class),
            resolve(AdvisorRepositoryInterface::class),
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
