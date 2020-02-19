<?php

namespace App\Providers;

use App\Repositories\Department\DepartmentRepository;
use App\Repositories\Department\EloquentDepartmentRepository;
use App\Repositories\Worker\EloquentWorkerRepository;
use App\Repositories\Worker\WorkerRepository;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(
            DepartmentRepository::class,
            EloquentDepartmentRepository::class
        );

        $this->app->bind(
            WorkerRepository::class,
            EloquentWorkerRepository::class
        );
    }
}
