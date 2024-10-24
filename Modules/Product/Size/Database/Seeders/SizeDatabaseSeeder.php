<?php

namespace Modules\Product\Size\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Product\Size\Models\Size;

class SizeDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $defaultSizes = ([
            [
                'name' => 'کوچک',
            ],

            [
                'name' => 'متوسط',
            ],

            [
            'name' => 'بزرگ',
            ],

            [
            'name' => 'خیلی بزرگ',
            ],

            [
            'name' => 'XS',
            ],

            [
            'name' => 'S',
            ],

            [
            'name' => 'M',
            ],

            [
            'name' => 'L',
            ],

            [
            'name' => 'XL',
            ],

            [
            'name' => 'XXL',
            ]
        ]);

        foreach ($defaultSizes as $size)
            Size::firstOrCreate($size);
    }
}
