<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Channel;
use View;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $channels = Channel::all();
        View::share('channels', $channels);
    }
}
