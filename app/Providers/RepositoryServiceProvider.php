<?php

namespace App\Providers;

use App\Models\Customer;
use App\Models\SuperAdmin;
use App\Repositories\Authentication\AuthenticationRepositoryInterface;
use App\Repositories\Authentication\AuthRepository;
use App\Repositories\Customers\CustomerRepository;
use App\Repositories\Customers\CustomerRepositoryInterface;
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

        // customer
        $this->app->singleton(CustomerRepositoryInterface::class,function (){
            return new CustomerRepository(new Customer());
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
