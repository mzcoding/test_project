<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\PersonalAccessToken;
use App\Services\Contracts\OrderCode;
use App\Services\Contracts\Rent;
use App\Services\ManageOrderCodeService;
use App\Services\ManageRentService;
use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\Sanctum;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(OrderCode::class, ManageOrderCodeService::class);
        $this->app->bind(Rent::class, ManageRentService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);
    }
}
