<?php

namespace Modules\Setting\Models;

use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings
{

    public string $site_name;
    public string $site_description;
    public string $copy_right;
    public string $support_email;
    public string $support_phone_number;
    public string $telegram_url;
    public string $instagram_url;

    public string $address;

    public string $logo;

    public static function group(): string
    {
        return 'general';
    }
}
