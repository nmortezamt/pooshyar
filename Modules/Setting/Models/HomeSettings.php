<?php

namespace Modules\Setting\Models;

use Spatie\LaravelSettings\Settings;

class HomeSettings extends Settings
{

    public static function group(): string
    {
        return 'home';
    }
}
