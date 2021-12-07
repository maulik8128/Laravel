<?php

namespace App\Facades;


use Illuminate\Support\Facades\Facade;
use App\Contracts\CounterContract;


class CounterFacades extends Facade
{
    /**
     * A Facade do Contract
     *
     * @method increment()
     */
    public static function getFacadeAccessor()
    {
        return CounterContract::class;
    }
}
