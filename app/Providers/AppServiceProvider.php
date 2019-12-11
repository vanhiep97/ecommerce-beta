<?php

namespace App\Providers;

use App\Repositories\Contracts\BrandRepositoryContract;
use App\Repositories\Contracts\CategoryRepositoryContract;
use App\Repositories\Contracts\ProductRepositoryContract;
use App\Repositories\Contracts\RoleRepositoryContract;
use App\Repositories\Contracts\TypeProductRepositoryContract;
use App\Repositories\Contracts\UserRepositoryContract;
use App\Repositories\Eloquents\BrandRepository;
use App\Repositories\Eloquents\CategoryRepository;
use App\Repositories\Eloquents\ProductRepository;
use App\Repositories\Eloquents\RoleRepository;
use App\Repositories\Eloquents\TypeProductRepository;
use App\Repositories\Eloquents\UserRepository;
use App\Services\Contracts\BrandServiceContract;
use App\Services\Contracts\CategoryServiceContract;
use App\Services\Contracts\ProductServiceContract;
use App\Services\Contracts\RoleServiceContract;
use App\Services\Contracts\TypeProductServiceContract;
use App\Services\Contracts\UserServiceContract;
use App\Services\Layers\BrandService;
use App\Services\Layers\CategoryService;
use App\Services\Layers\ProductService;
use App\Services\Layers\RoleService;
use App\Services\Layers\TypeProductService;
use App\Services\Layers\UserService;
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
        $this->app->bind(UserRepositoryContract::class, UserRepository::class);
        $this->app->bind(UserServiceContract::class, UserService::class);

        $this->app->bind(RoleRepositoryContract::class, RoleRepository::class);
        $this->app->bind(RoleServiceContract::class, RoleService::class);

        $this->app->bind(CategoryRepositoryContract::class, CategoryRepository::class);
        $this->app->bind(CategoryServiceContract::class, CategoryService::class);

        $this->app->bind(TypeProductRepositoryContract::class, TypeProductRepository::class);
        $this->app->bind(TypeProductServiceContract::class, TypeProductService::class);

        $this->app->bind(BrandRepositoryContract::class, BrandRepository::class);
        $this->app->bind(BrandServiceContract::class, BrandService::class);

        $this->app->bind(ProductRepositoryContract::class, ProductRepository::class);
        $this->app->bind(ProductServiceContract::class, ProductService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
