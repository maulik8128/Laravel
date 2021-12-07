<?php

namespace App\Providers;

use App\Services\Counter;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Resources\Json\JsonResource;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment('local')) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::aliasComponent('components.form','form');
        Blade::aliasComponent('components.form-input','formInput');
        Blade::aliasComponent('components.form-select','formSelect');
        Blade::aliasComponent('components.form-input-value','formInputWithValue');




        // CommentResource::withoutWrapping();
        ///All JsonResource withoutWrapping
        JsonResource::withoutWrapping();

        $this->app->singleton(Counter::class, function($app){
            return new Counter(random_int(5,100),
        $app->make('Illuminate\Contracts\Session\Session')
            );
        });

        $this->app->bind(
            'App\Contracts\CounterContract',
            Counter::class
        );
    }
}
