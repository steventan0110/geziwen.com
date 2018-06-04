<?php

namespace App\Providers;

use App\Agency\Agency;
use App\Agency\Teacher;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Relation::morphMap([
            'agencies' => Agency::class,
            'teachers' => Teacher::class
        ]);
        Blade::if('create', function () {
            return strpos(Route::currentRouteName(), 'create') != false;
        });
        Blade::if('edit', function () {
            return strpos(Route::currentRouteName(), 'edit') != false;
        });
    }


    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
