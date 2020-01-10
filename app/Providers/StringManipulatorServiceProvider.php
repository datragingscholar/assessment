<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Domain\Services\iStringManipulator;
use App\Domain\Services\StringManipulatorService;

class StringManipulatorServiceProvider extends ServiceProvider
{
    public $bindings = [
        iStringManipulator::class => StringManipulatorService::class,
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
