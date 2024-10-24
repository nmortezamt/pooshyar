<?php

namespace Modules\Banner\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Banner\Models\Banner;

class BannerDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $defaultBanners = ([
            [
                'title' => 'تخفیف ویژه تابستانه',
                'img' => 'summer-sale-banner.jpg',
                'description' => 'تا ۵۰٪ تخفیف روی تمامی محصولات تابستانی.',
                'slug' => 'summer-sale',
                'status' => 'active',
            ],
            [
                'title' => 'حراج آخر فصل',
                'img' => 'end-of-season-banner.jpg',
                'description' => 'حراج بزرگ آخر فصل با تخفیفات بی‌نظیر.',
                'slug' => 'end-of-season-sale',
                'status' => 'active',
            ],
            [
                'title' => 'محصولات جدید',
                'img' => 'new-arrivals-banner.jpg',
                'description' => 'محصولات جدید به مجموعه ما اضافه شده‌اند، از دست ندهید!',
                'slug' => 'new-arrivals',
                'status' => 'active',
            ],
            [
                'title' => 'تخفیف ویژه پاییزه',
                'img' => 'autumn-sale-banner.jpg',
                'description' => 'تا ۳۰٪ تخفیف روی تمامی پوشاک پاییزه.',
                'slug' => 'autumn-sale',
                'status' => 'active',
            ],
            [
                'title' => 'حراج بلک فرایدی',
                'img' => 'black-friday-banner.jpg',
                'description' => 'بزرگ‌ترین حراج سال، بلک فرایدی! تا ۷۰٪ تخفیف.',
                'slug' => 'black-friday-sale',
                'status' => 'active',
            ],
        ]);
        foreach ($defaultBanners as $banner)
            Banner::firstOrCreate($banner);
    }
}
