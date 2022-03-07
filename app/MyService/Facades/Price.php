<?php


namespace App\MyService\Facades;

use Illuminate\Support\Facades\Facade;

class Price extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'price';
    }
}
