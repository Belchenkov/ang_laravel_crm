<?php


namespace App\Services\Date;


class DateCheck
{
    public static function isValid(string $str_dt, string $str_date_format = 'Y-m-d'): bool
    {
        $date = \DateTime::createFromFormat($str_date_format, $str_dt);

        if ($date && (int)$date->format('Y') < 1900) {
            return false;
        }

        return $date
            && (int)\DateTime::getLastErrors()['warning_count'] === 0
            && (int)\DateTime::getLastErrors()['error_count'] === 0;
    }
}
