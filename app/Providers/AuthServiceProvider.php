<?php

namespace App\Providers;

use App\Agency\Agency;
use App\Applicant\Applicant;
use App\Policies\AgencyPolicy;
use App\Policies\ApplicantPolicy;
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
        Applicant::class => ApplicantPolicy::class
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
    }
}
