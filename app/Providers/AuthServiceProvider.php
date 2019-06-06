<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
      'App\Event' => 'App\Policies\EventPolicy',
      'App\Post' => 'App\Policies\PostPolicy',
      'App\EventReport' => 'App\Policies\ReportPolicy',
      'App\Question' => 'App\Policies\QuestionPolicy',
      'App\Answer' => 'App\Policies\AnswerPolicy',
      'App\Thread' => 'App\Policies\ThreadPolicy'
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
