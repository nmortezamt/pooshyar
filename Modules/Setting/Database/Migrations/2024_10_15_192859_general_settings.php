<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.site_name', 'rojan style');
        $this->migrator->add('general.site_description', 'rojan style description');
        $this->migrator->add('general.copy_right', 'copy right');
        $this->migrator->add('general.support_email', 'support@example.com');
        $this->migrator->add('general.support_phone_number', '0912000000');
        $this->migrator->add('general.instagram_url', 'https://www.instagram.com');
        $this->migrator->add('general.telegram_url', 'https://telegram.org');
        $this->migrator->add('general.address', 'arak');
        $this->migrator->add('general.logo', 'logo.png');
    }
};
