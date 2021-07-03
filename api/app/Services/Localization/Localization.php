<?php


namespace App\Services\Localization;


use Illuminate\Support\Facades\App;

class Localization
{
    public function locale()
    {
        $locale = request()->segment(1);

        if ($locale && in_array($locale, config('app.locales'))) {
            App::setLocale($locale);
            return $locale;
        }
    }
}
