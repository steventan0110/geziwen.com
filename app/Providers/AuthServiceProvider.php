<?php

namespace App\Providers;

use App\Agency\Agency;
use App\Agency\Service\Plan;
use App\Agency\Teacher;
use App\Comment\Comment;
use App\Applicant\Applicant;
use App\Policies\AgencyPolicy;
use App\Policies\ApplicantPolicy;
use App\Policies\CommentPolicy;
use App\Policies\PlanPolicy;
use App\Policies\TeacherPolicy;
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
        'App\Model' => 'App\Policies\ModelPolicy',
        Agency::class => AgencyPolicy::class,
        Applicant::class => ApplicantPolicy::class,
        Teacher::class => TeacherPolicy::class,
        Plan::class => PlanPolicy::class,
        Comment::class => CommentPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::resource('agencies', AgencyPolicy::class);
//        Gate::resource('plans', PlanPolicy::class);
    }
}
