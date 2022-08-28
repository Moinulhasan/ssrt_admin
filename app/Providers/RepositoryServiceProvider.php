<?php

namespace App\Providers;

use App\Models\SuperAdmin;
use App\Repositories\Authentication\AuthenticationRepositoryInterface;
use App\Repositories\Authentication\AuthRepository;
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
        $this->app->singleton(AuthenticationRepositoryInterface::class,function (){
            return new AuthRepository(new SuperAdmin());
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
