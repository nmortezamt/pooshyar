<?php

namespace Modules\Product\Brand\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Product\Brand\Models\Brand;

class BrandDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $defaultBrands = ([
            [
                'name' => 'نایک',
                'slug' => 'نایک',
                'status' => Brand::ACTIVE_STATUS,
                'description' => 'نایک یکی از بزرگترین تولیدکنندگان کفش و لباس‌های ورزشی در جهان.',
                'img' => 'nike-logo.jpg',
            ],
            [
                'name' => 'آدیداس',
                'slug' => 'آدیداس',
                'status' => Brand::ACTIVE_STATUS,
                'description' => 'آدیداس برندی معتبر در تولید پوشاک و تجهیزات ورزشی.',
                'img' => 'adidas-logo.jpg',
            ],
            [
                'name' => 'زارا',
                'slug' => 'زارا',
                'status' => Brand::ACTIVE_STATUS,
                'description' => 'زارا برندی اسپانیایی با تولید پوشاک مد روز و شیک.',
                'img' => 'zara-logo.jpg',
            ],
            [
                'name' => 'گوچی',
                'slug' => 'گوچی',
                'status' => Brand::ACTIVE_STATUS,
                'description' => 'گوچی یک برند لوکس ایتالیایی با طراحی‌های خاص در پوشاک و اکسسوری.',
                'img' => 'gucci-logo.jpg',
            ],
            [
                'name' => 'لیوایز',
                'slug' => 'لیوایز',
                'status' => Brand::ACTIVE_STATUS,
                'description' => 'لیوایز معروف به تولید شلوارهای جین با کیفیت بالا.',
                'img' => 'levis-logo.jpg',
            ]

        ]);

        foreach ($defaultBrands as $brand)
            Brand::firstOrCreate($brand);
    }
}
