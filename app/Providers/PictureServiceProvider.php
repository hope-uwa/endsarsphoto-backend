<?php

namespace App\Providers;

use App\Services\PictureService;
use App\Repository\PictureInterface;
use Illuminate\Support\ServiceProvider;

class PictureServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            PictureInterface::class, 
            PictureService::class
         );
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
