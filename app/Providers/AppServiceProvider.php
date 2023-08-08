<?php

namespace App\Providers;

use App\helpers\Repositories\CallOutRepository;
use App\helpers\Repositories\NurseRepository;
use App\Http\Controllers\CallOutController;
use App\Services\Admin\CallOutService;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

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
    public function boot(): void
    {
        if (env('APP_ENV', 'local') != 'local') {
            URL::forceScheme('https');
        }

        $this->app->bind(CallOutService::class, function () {
            return new CallOutService(new CallOutRepository(), new NurseRepository());
        });

        // Paginator
        Paginator::useBootstrap();
    }
}
