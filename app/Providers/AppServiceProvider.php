<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    public $serviceBindings = [
        'App\Services\Interfaces\UserServiceInterface' => 'App\Services\UserService',
        'App\Reponsitories\Interfaces\UserReponsitoryInterface' => 'App\Reponsitories\UserReponsitory',

        'App\Services\Interfaces\UserCatalogueServiceInterface' => 'App\Services\UserCatalogueService',
        'App\Reponsitories\Interfaces\UserCatalogueReponsitoryInterface' => 'App\Reponsitories\UserCatalogueReponsitory',
        
        'App\Services\Interfaces\ProductServiceInterface' => 'App\Services\ProductService',
        'App\Reponsitories\Interfaces\ProductReponsitoryInterface' => 'App\Reponsitories\ProductReponsitory',

        'App\Services\Interfaces\ShoeTypeServiceInterface' => 'App\Services\ShoeTypeService',
        'App\Reponsitories\Interfaces\ShoeTypeReponsitoryInterface' => 'App\Reponsitories\ShoeTypeReponsitory',
        
        'App\Services\Interfaces\BrandServiceInterface' => 'App\Services\BrandService',
        'App\Reponsitories\Interfaces\BrandReponsitoryInterface' => 'App\Reponsitories\BrandReponsitory',
        
        'App\Services\Interfaces\PromotionServiceInterface' => 'App\Services\PromotionService',
        'App\Reponsitories\Interfaces\PromotionReponsitoryInterface' => 'App\Reponsitories\PromotionReponsitory',

        'App\Services\Interfaces\MainServiceInterface' => 'App\Services\MainService',
        'App\Reponsitories\Interfaces\MainReponsitoryInterface' => 'App\Reponsitories\MainReponsitory',
        
        'App\Reponsitories\Interfaces\ProvinceReponsitoryInterface' => 'App\Reponsitories\ProvinceReponsitory',
        'App\Reponsitories\Interfaces\WardReponsitoryInterface' => 'App\Reponsitories\WardReponsitory',
        'App\Reponsitories\Interfaces\DistrictReponsitoryInterface' => 'App\Reponsitories\DistrictReponsitory',
    ];
    /**
     * Register any application services.
     */
    public function register(): void
    {
        foreach ($this->serviceBindings as $key => $value) {
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
