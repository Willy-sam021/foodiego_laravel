<?php

namespace App\Providers;
use App\Services\ProductService;
use App\Repositories\ProductRepository;
use App\Services\CategoryService;
use App\Services\SellerService;
use App\Repositories\SellerRepository;
use App\Repositories\UserRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\CartRepository;
use App\Repositories\OrderRepository;
use App\Services\CartService;
use App\Services\OrderService;
use App\Services\PaymentService;
use App\Repositories\PaymentRepository;
use App\Models\Payment;
use App\Observers\PaymentObserver;
use App\Services\AdminService;
use App\Repositories\AdminRepository;

use Illuminate\Support\ServiceProvider;



class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ProductService::class, function () {
            return new ProductService(new ProductRepository);
        });
        $this->app->bind(CategoryService::class, function () {
            return new CategoryService(new CategoryRepository);
        });
        $this->app->bind(SellerService::class, function () {
            return new SellerService(new SellerRepository, new UserRepository);
        });
        $this->app->bind(CartService::class, function(){
            return new CartService(new CartRepository,new ProductRepository );
        });
        $this->app->bind(OrderService::class, function(){
            return new OrderService(new OrderRepository,new CartRepository );
        });
        $this->app->bind(PaymentService::class, function(){
            return new PaymentService(new PaymentRepository, new OrderRepository);
        });
        $this->app->bind(AdminService::class, function(){
            return new AdminService(new AdminRepository, new UserRepository, new OrderRepository);
        });


    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Payment::observe(PaymentObserver::class);
    }
}
