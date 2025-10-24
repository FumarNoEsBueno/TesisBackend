<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;
use App\Models\Cable;
use App\Models\Cargador;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
    }

    public function boot(): void
    {
        Relation::morphMap([
            'cable'    => Cable::class,
            'cargador' => Cargador::class,
        ]);
    }
}
