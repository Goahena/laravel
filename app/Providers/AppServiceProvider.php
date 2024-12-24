<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    public $serviceBindings = [
        'App\Services\Interfaces\UserServiceInterface' => 'App\Services\UserService',
        'App\Repositories\Interfaces\UserRepositoryInterface' => 'App\Repositories\UserRepository',

        'App\Services\Interfaces\UserCatalogueServiceInterface' => 'App\Services\UserCatalogueService',
        'App\Repositories\Interfaces\UserCatalogueRepositoryInterface' => 'App\Repositories\UserCatalogueRepository',
        
        'App\Services\Interfaces\LanguageServiceInterface' => 'App\Services\LanguageService',
        'App\Repositories\Interfaces\LanguageRepositoryInterface' => 'App\Repositories\LanguageRepository',

        'App\Services\Interfaces\ProductServiceInterface' => 'App\Services\ProductService',
        'App\Repositories\Interfaces\ProductRepositoryInterface' => 'App\Repositories\ProductRepository',

        'App\Services\Interfaces\ShoeTypeServiceInterface' => 'App\Services\ShoeTypeService',
        'App\Repositories\Interfaces\ShoeTypeRepositoryInterface' => 'App\Repositories\ShoeTypeRepository',
        
        'App\Services\Interfaces\BrandServiceInterface' => 'App\Services\BrandService',
        'App\Repositories\Interfaces\BrandRepositoryInterface' => 'App\Repositories\BrandRepository',
        
        'App\Services\Interfaces\PromotionServiceInterface' => 'App\Services\PromotionService',
        'App\Repositories\Interfaces\PromotionRepositoryInterface' => 'App\Repositories\PromotionRepository',

        'App\Services\Interfaces\MainServiceInterface' => 'App\Services\MainService',
        'App\Repositories\Interfaces\MainRepositoryInterface' => 'App\Repositories\MainRepository',
        
        'App\Repositories\Interfaces\ProvinceRepositoryInterface' => 'App\Repositories\ProvinceRepository',
        'App\Repositories\Interfaces\WardRepositoryInterface' => 'App\Repositories\WardRepository',
        'App\Repositories\Interfaces\DistrictRepositoryInterface' => 'App\Repositories\DistrictRepository',
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
