<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    public $serviceBindings = [
        'App\Services\Interfaces\UserServiceInterface' => 'App\Services\UserService',
        'App\Reponsitories\Interfaces\UserReponsitoryInterface' => 'App\Reponsitories\UserReponsitory',
        'App\Reponsitories\Interfaces\ProvinceReponsitoryInterface' => 'App\Reponsitories\ProvinceReponsitory',
        'App\Reponsitories\Interfaces\WardReponsitoryInterface' => 'App\Reponsitories\WardReponsitory',
        'App\Reponsitories\Interfaces\DistrictReponsitoryInterface' => 'App\Reponsitories\DistrictReponsitory',
    ];
    /**
     * Register any application services.
     */
    public function register(): void
    {
        foreach($this->serviceBindings as $key => $value) {
            $this->app->bind($key, $value);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
    }
}
