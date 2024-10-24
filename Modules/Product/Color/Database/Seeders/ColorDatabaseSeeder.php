<?php

namespace Modules\Product\Color\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Product\Color\Models\Color;

class ColorDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $defaultColors = ([
            [
                'value' => '#FF5733',
                'name' => 'نارنجی',
            ],
            [
                'value' => '#33FF57',
                'name' => 'سبز روشن',
            ],
            [
                'value' => '#3357FF',
                'name' => 'آبی',
            ],
            [
                'value' => '#FFD700',
                'name' => 'طلایی',
            ],
            [
                'value' => '#8B4513',
                'name' => 'قهوه‌ای',
            ],
            [
                'value' => '#000000',
                'name' => 'مشکی',
            ],
            [
                'value' => '#FFFFFF',
                'name' => 'سفید',
            ],
            [
            'value' => '#FF6347',
            'name' => 'قرمز گوجه‌ای',
            ],
            ['value' => '#800080', 'name' => 'بنفش']
        ]);

        foreach ($defaultColors as $color)
            Color::firstOrCreate($color);
    }
}
