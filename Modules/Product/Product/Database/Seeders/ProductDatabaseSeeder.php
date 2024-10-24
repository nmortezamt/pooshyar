<?php

namespace Modules\Product\Product\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Product\Product\Models\Product;

class ProductDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $defaultProducts = ([
            [
                'img' => 'product1.jpg',
                'title' => 'پیراهن مردانه آستین کوتاه',
                'slug' => 'پیراهن-مردانه-آستین-کوتاه',
                'category_id' => 1,
                'subcategory_id' => 1,
                'body' => 'پیراهن مردانه آستین کوتاه با طراحی مدرن.',
                'price' => 450000,
                'price_major' => 500000,
                'description' => 'این پیراهن از جنس پنبه ساخته شده و بسیار راحت است.',
                'quantity' => 50,
                'is_published' => true,
                'status' => Product::ACTIVE_STATUS,
                'brand_id' => 1,
                'order_count' => 20,
                'description_seo' => 'پیراهن مردانه آستین کوتاه با کیفیت عالی.',
            ],
            [
                'img' => 'product2.jpg',
                'title' => 'شلوار جین زنانه',
                'slug' => 'شلوار-جین-زنانه',
                'category_id' => 2,
                'subcategory_id' => 2,
                'body' => 'شلوار جین زنانه با طراحی زیبا و کیفیت بالا.',
                'price' => 700000,
                'price_major' => 750000,
                'description' => 'این شلوار جین با بهترین مواد اولیه تهیه شده است.',
                'quantity' => 30,
                'is_published' => true,
                'status' => Product::ACTIVE_STATUS,
                'brand_id' => 2,
                'order_count' => 15,
                'description_seo' => 'شلوار جین زنانه با طراحی مدرن و کیفیت عالی.',
            ],
            [
                'img' => 'product3.jpg',
                'title' => 'کفش اسپرت مردانه',
                'slug' => 'کفش-اسپرت-مردانه',
                'category_id' => 3,
                'subcategory_id' => 3,
                'body' => 'کفش اسپرت مردانه برای ورزش و استفاده روزمره.',
                'price' => 800000,
                'price_major' => 850000,
                'description' => 'کفش‌های اسپرت مردانه با طراحی ارگونومیک.',
                'quantity' => 25,
                'is_published' => true,
                'status' => Product::ACTIVE_STATUS,
                'brand_id' => 3,
                'order_count' => 10,
                'description_seo' => 'کفش اسپرت مردانه با طراحی جذاب و راحتی بالا.',
            ],
            [
                'img' => 'product4.jpg',
                'title' => 'کاپشن زمستانی زنانه',
                'slug' => 'کاپشن-زمستانی-زنانه',
                'category_id' => 1,
                'subcategory_id' => 4,
                'body' => 'کاپشن زمستانی زنانه با کیفیت عالی و عایق حرارتی.',
                'price' => 1200000,
                'price_major' => 1300000,
                'description' => 'این کاپشن مناسب برای روزهای سرد زمستان است.',
                'quantity' => 40,
                'is_published' => true,
                'status' => Product::ACTIVE_STATUS,
                'brand_id' => 4,
                'order_count' => 5,
                'description_seo' => 'کاپشن زمستانی زنانه با طراحی شیک و گرم.',
            ],
            [
                'img' => 'product5.jpg',
                'title' => 'کت و شلوار مردانه',
                'slug' => 'کت-و-شلوار-مردانه',
                'category_id' => 2,
                'subcategory_id' => 5,
                'body' => 'کت و شلوار مردانه برای مجالس و مراسم رسمی.',
                'price' => 2000000,
                'price_major' => 2200000,
                'description' => 'کت و شلوار با کیفیت عالی و طراحی مدرن.',
                'quantity' => 15,
                'is_published' => true,
                'status' => Product::ACTIVE_STATUS,
                'brand_id' => 5,
                'order_count' => 8,
                'description_seo' => 'کت و شلوار مردانه مناسب برای مجالس و مراسم.',
            ],
            [
                'img' => 'product6.jpg',
                'title' => 'تی‌شرت زنانه',
                'slug' => 'تی‌شرت-زنانه',
                'category_id' => 1,
                'subcategory_id' => 1,
                'body' => 'تی‌شرت زنانه با طراحی ساده و جذاب.',
                'price' => 350000,
                'price_major' => 400000,
                'description' => 'تی‌شرت با جنس نرم و راحت برای استفاده روزمره.',
                'quantity' => 60,
                'is_published' => true,
                'status' => Product::ACTIVE_STATUS,
                'brand_id' => 1,
                'order_count' => 12,
                'description_seo' => 'تی‌شرت زنانه با کیفیت و طراحی زیبا.',
            ],
            [
                'img' => 'product7.jpg',
                'title' => 'کمربند چرمی مردانه',
                'slug' => 'کمربند-چرمی-مردانه',
                'category_id' => 3,
                'subcategory_id' => 2,
                'body' => 'کمربند چرمی مردانه با کیفیت و طراحی زیبا.',
                'price' => 400000,
                'price_major' => 450000,
                'description' => 'این کمربند مناسب برای استفاده روزمره و رسمی است.',
                'quantity' => 35,
                'is_published' => true,
                'status' => Product::ACTIVE_STATUS,
                'brand_id' => 2,
                'order_count' => 6,
                'description_seo' => 'کمربند چرمی مردانه با طراحی کلاسیک.',
            ],
            [
                'img' => 'product8.jpg',
                'title' => 'عینک آفتابی زنانه',
                'slug' => 'عینک-آفتابی-زنانه',
                'category_id' => 4,
                'subcategory_id' => 3,
                'body' => 'عینک آفتابی زنانه با طراحی مدرن و جذاب.',
                'price' => 300000,
                'price_major' => 350000,
                'description' => 'این عینک محافظ UV و مناسب برای تابستان است.',
                'quantity' => 20,
                'is_published' => true,
                'status' => Product::ACTIVE_STATUS,
                'brand_id' => 3,
                'order_count' => 9,
                'description_seo' => 'عینک آفتابی زنانه با کیفیت و طراحی خاص.',
            ],
            [
                'img' => 'product9.jpg',
                'title' => 'کیف دستی زنانه',
                'slug' => 'کیف-دستی-زنانه',
                'category_id' => 2,
                'subcategory_id' => 4,
                'body' => 'کیف دستی زنانه با طراحی شیک و جا دار.',
                'price' => 950000,
                'price_major' => 1000000,
                'description' => 'این کیف مناسب برای استفاده روزمره و مهمانی‌ها است.',
                'quantity' => 30,
                'is_published' => true,
                'status' => Product::ACTIVE_STATUS,
                'brand_id' => 4,
                'order_count' => 11,
                'description_seo' => 'کیف دستی زنانه با طراحی زیبا و کیفیت بالا.',
            ],
            [
                'img' => 'product10.jpg',
                'title' => 'کت جین مردانه',
                'slug' => 'کت-جین-مردانه',
                'category_id' => 1,
                'subcategory_id' => 5,
                'body' => 'کت جین مردانه با طراحی مدرن و با کیفیت.',
                'price' => 850000,
                'price_major' => 900000,
                'description' => 'کت جین با طراحی خاص برای استایل کژوال.',
                'quantity' => 40,
                'is_published' => true,
                'status' => Product::ACTIVE_STATUS,
                'brand_id' => 5,
                'order_count' => 14,
                'description_seo' => 'کت جین مردانه با کیفیت و طراحی جذاب.',
            ]
        ]);
        foreach ($defaultProducts as $product)
            Product::firstOrCreate($product);

        $productSizes = [
            [
                'product_id' => 1,
                'size_id' => 1,
            ],
            [
                'product_id' => 1,
                'size_id' => 2,
            ],
            [
                'product_id' => 2,
                'size_id' => 1,
            ],
            [
                'product_id' => 2,
                'size_id' => 3,
            ],
            [
                'product_id' => 3,
                'size_id' => 2,
            ],
            [
                'product_id' => 3,
                'size_id' => 4,
            ],
            [
                'product_id' => 4,
                'size_id' => 1,
            ],
            [
                'product_id' => 4,
                'size_id' => 3,
            ],
            [
                'product_id' => 5,
                'size_id' => 3,
            ],
            [
                'product_id' => 5,
                'size_id' => 1,
            ],
            [
                'product_id' => 6,
                'size_id' => 5,
            ],
            [
                'product_id' => 6,
                'size_id' => 2,
            ],
            [
                'product_id' => 7,
                'size_id' => 2,
            ],
            [
                'product_id' => 7,
                'size_id' => 4,
            ],
            [
                'product_id' => 8,
                'size_id' => 4,
            ],
            [
                'product_id' => 8,
                'size_id' => 5,
            ],
            [
                'product_id' => 9,
                'size_id' => 2,
            ],
            [
                'product_id' => 9,
                'size_id' => 3,
            ],
            [
                'product_id' => 10,
                'size_id' => 3,
            ],
            [
                'product_id' => 10,
                'size_id' => 4,
            ],
        ];

        DB::table('product_sizes')->insert($productSizes);

        $productColors = [
            [
                'product_id' => 1,
                'color_id' => 1,
            ],
            [
                'product_id' => 1,
                'color_id' => 2,
            ],
            [
                'product_id' => 2,
                'color_id' => 1,
            ],
            [
                'product_id' => 2,
                'color_id' => 3,
            ],
            [
                'product_id' => 3,
                'color_id' => 2,
            ],
            [
                'product_id' => 3,
                'color_id' => 4,
            ],
            [
                'product_id' => 4,
                'color_id' => 3,
            ],
            [
                'product_id' => 4,
                'color_id' => 5,
            ],
            [
                'product_id' => 5,
                'color_id' => 1,
            ],
            [
                'product_id' => 5,
                'color_id' => 2,
            ],
            [
                'product_id' => 6,
                'color_id' => 3,
            ],
            [
                'product_id' => 6,
                'color_id' => 4,
            ],
            [
                'product_id' => 7,
                'color_id' => 4,
            ],
            [
                'product_id' => 7,
                'color_id' => 5,
            ],
            [
                'product_id' => 8,
                'color_id' => 4,
            ],
            [
                'product_id' => 8,
                'color_id' => 5,
            ],
            [
                'product_id' => 9,
                'color_id' => 4,
            ],
            [
                'product_id' => 9,
                'color_id' => 5,
            ],
            [
                'product_id' => 10,
                'color_id' => 2,
            ],
            [
                'product_id' => 10,
                'color_id' => 4,
            ],

        ];

        DB::table('product_colors')->insert($productColors);
    }
}
