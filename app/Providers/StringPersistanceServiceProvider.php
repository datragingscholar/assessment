<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Persistance\iStringPersistance;
use App\Persistance\CSVPersistance;

class StringPersistanceServiceProvider extends ServiceProvider
{
    public $bindings = [
        iStringPersistance::class => CSVPersistance::class,
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
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
