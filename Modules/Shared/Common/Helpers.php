<?php

namespace Modules\Shared\Common;

class Helpers
{
    public static function convertNumbersToPersian($number):string
    {
        $englishDigits = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        $persianDigits = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];

        return str_replace($englishDigits, $persianDigits, $number);
    }
}
