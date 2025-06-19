<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
    }

    public function boot(): void
    {
//        Passport::tokensExpireIn(now()->addDays(7));
  //      Passport::refreshTokensExpireIn(now()->addDays(7));
    //    Passport::personalAccessTokensExpireIn(now()->addDays(31));
    }
}
