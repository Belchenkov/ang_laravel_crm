<?php


namespace App\Services\Date\Facade;


use Illuminate\Support\Facades\Facade;

class DateService extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'dateCheck';
    }
}
