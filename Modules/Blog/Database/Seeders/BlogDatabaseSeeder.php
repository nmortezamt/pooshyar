<?php

namespace Modules\Blog\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Blog\Models\Blog;

class BlogDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $defaultBlogs = ([
                [
                    'title' => 'تاثیر تکنولوژی بر زندگی روزمره',
                    'slug' => 'تاثیر-تکنولوژی-بر-زندگی-روزمره',
                    'status' => 'published',
                    'body' => 'تکنولوژی روز به روز در حال تغییر زندگی ماست و این تغییرات در همه جنبه‌های زندگی ما تأثیرگذار است...',
                    'description' => 'بررسی تاثیرات تکنولوژی بر زندگی روزمره افراد و نحوه سازگاری با آن.',
                    'description_seo' => 'تکنولوژی، تاثیر تکنولوژی، زندگی روزمره، دیجیتال',
                    'category_id' => 1,
                    'subcategory_id' => 1,
                    'view' => 350,
                    'img' => 'technology-impact.jpg',
                ],
                [
                    'title' => 'راهنمای کامل تغذیه سالم',
                    'slug' => 'راهنمای-کامل-تغذیه-سالم',
                    'status' => 'published',
                    'body' => 'تغذیه سالم یکی از اصول مهم برای حفظ سلامت بدن است. در این مقاله به بررسی نکات مهم تغذیه سالم پرداخته‌ایم...',
                    'description' => 'مقاله‌ای جامع برای راهنمایی در مورد تغذیه سالم و رژیم‌های غذایی مناسب.',
                    'description_seo' => 'تغذیه سالم، رژیم غذایی، سلامت بدن، غذاهای مفید',
                    'category_id' => 2,
                    'subcategory_id' => 2,
                    'view' => 420,
                    'img' => 'healthy-nutrition-guide.jpg',
                ],
                [
                    'title' => '۵ مکان دیدنی برای سفر تابستانی',
                    'slug' => '۵-مکان-دیدنی-برای-سفر-تابستانی',
                    'status' => 'draft',
                    'body' => 'تابستان بهترین فرصت برای سفر و گشت و گذار است. در این مقاله ۵ مکان دیدنی برای سفر در فصل تابستان معرفی می‌کنیم...',
                    'description' => 'معرفی بهترین مقاصد گردشگری برای سفر در تابستان.',
                    'description_seo' => 'مکان‌های دیدنی، سفر تابستانی، گردشگری، مقاصد گردشگری',
                    'category_id' => 4,
                    'subcategory_id' => 4,
                    'view' => 150,
                    'img' => 'summer-travel-destinations.jpg',
                ],
                [
                    'title' => 'چگونه می‌توانیم مدیریت زمان بهتری داشته باشیم؟',
                    'slug' => 'چگونه-مدیریت-زمان-بهتری-داشته-باشیم',
                    'status' => 'published',
                    'body' => 'مدیریت زمان یکی از مهارت‌های کلیدی برای موفقیت در زندگی است. در این مقاله به روش‌های موثر مدیریت زمان پرداخته‌ایم...',
                    'description' => 'روش‌های کاربردی برای بهبود مدیریت زمان و افزایش بهره‌وری.',
                    'description_seo' => 'مدیریت زمان، بهره‌وری، نکات موفقیت، مهارت‌های زندگی',
                    'category_id' => 5,
                    'subcategory_id' => 5,
                    'view' => 500,
                    'img' => 'time-management-tips.jpg',
                ],
                [
                    'title' => 'بهترین تمرینات برای تقویت عضلات',
                    'slug' => 'بهترین-تمرینات-برای-تقویت-عضلات',
                    'status' => 'published',
                    'body' => 'ورزش و تمرینات مناسب می‌تواند به تقویت عضلات و بهبود تناسب اندام کمک کند. در این مقاله به معرفی بهترین تمرینات پرداخته‌ایم...',
                    'description' => 'تمرینات موثر برای تقویت عضلات بدن و بهبود وضعیت فیزیکی.',
                    'description_seo' => 'تمرینات عضلات، تناسب اندام، ورزش، تمرینات بدنسازی',
                    'category_id' => 9,
                    'subcategory_id' => 9,
                    'view' => 720,
                    'img' => 'muscle-building-exercises.jpg',
                ],
                [
                    'title' => 'چطور از گجت‌های هوشمند به بهترین شکل استفاده کنیم؟',
                    'slug' => 'استفاده-موثر-از-گجت-های-هوشمند',
                    'status' => 'draft',
                    'body' => 'گجت‌های هوشمند به بخش مهمی از زندگی ما تبدیل شده‌اند. در این مقاله به نکاتی برای استفاده بهینه از این گجت‌ها پرداخته‌ایم...',
                    'description' => 'راهنمایی برای استفاده بهینه و موثر از گجت‌های هوشمند در زندگی روزمره.',
                    'description_seo' => 'گجت‌های هوشمند، استفاده از تکنولوژی، نکات فناوری، هوشمندسازی',
                    'category_id' => 1,
                    'subcategory_id' => 1,
                    'view' => 310,
                    'img' => 'smart-gadgets.jpg',
                ],
                [
                    'title' => 'مزایای یوگا برای سلامت روان',
                    'slug' => 'مزایای-یوگا-برای-سلامت-روان',
                    'status' => 'published',
                    'body' => 'یوگا نه تنها برای سلامت جسمی بلکه برای بهبود سلامت روان نیز بسیار مفید است. در این مقاله به بررسی این مزایا پرداخته‌ایم...',
                    'description' => 'چگونه یوگا می‌تواند به بهبود سلامت روان کمک کند.',
                    'description_seo' => 'یوگا، سلامت روان، آرامش ذهنی، تمرینات یوگا',
                    'category_id' => 2,
                    'subcategory_id' => 2,
                    'view' => 640,
                    'img' => 'yoga-mental-health.jpg',
                ],
                [
                    'title' => 'برترین ترندهای مد در سال ۲۰۲۴',
                    'slug' => 'ترندهای-مد-سال-۲۰۲۴',
                    'status' => 'published',
                    'body' => 'هر ساله دنیای مد تغییرات جدیدی را تجربه می‌کند. در این مقاله برترین ترندهای مد سال ۲۰۲۴ را بررسی می‌کنیم...',
                    'description' => 'معرفی جدیدترین ترندهای مد و فشن در سال ۲۰۲۴.',
                    'description_seo' => 'ترندهای مد، مد ۲۰۲۴، فشن، پوشاک جدید',
                    'category_id' => 8,
                    'subcategory_id' => 8,
                    'view' => 890,
                    'img' => 'fashion-trends-2024.jpg',
                ],
                [
                    'title' => 'چگونه در بازار ارزهای دیجیتال سرمایه‌گذاری کنیم؟',
                    'slug' => 'سرمایه-گذاری-در-ارزهای-دیجیتال',
                    'status' => 'published',
                    'body' => 'ارزهای دیجیتال به یکی از محبوب‌ترین روش‌های سرمایه‌گذاری تبدیل شده‌اند. در این مقاله به نکاتی برای شروع سرمایه‌گذاری در این بازار پرداخته‌ایم...',
                    'description' => 'راهنمای جامع برای شروع سرمایه‌گذاری در ارزهای دیجیتال.',
                    'description_seo' => 'سرمایه‌گذاری، ارزهای دیجیتال، بیت‌کوین، بازار مالی',
                    'category_id' => 7,
                    'subcategory_id' => 7,
                    'view' => 1100,
                    'img' => 'crypto-investment-guide.jpg',
                ],
                [
                    'title' => 'نقد و بررسی فیلم جدید اسکورسیزی',
                    'slug' => 'نقد-فیلم-جدید-اسکورسیزی',
                    'status' => 'draft',
                    'body' => 'مارتین اسکورسیزی با فیلم جدید خود بار دیگر به دنیای سینما بازگشته است. در این مقاله به نقد و بررسی این فیلم پرداخته‌ایم...',
                    'description' => 'نقد و بررسی فیلم جدید مارتین اسکورسیزی و تحلیل نقاط قوت و ضعف آن.',
                    'description_seo' => 'نقد فیلم، سینما، مارتین اسکورسیزی، فیلم جدید',
                    'category_id' => 10,
                    'subcategory_id' => 10,
                    'view' => 270,
                    'img' => 'scorsese-new-movie-review.jpg',
                ],
        ]);

        foreach ($defaultBlogs as $blog)
            Blog::firstOrCreate($blog);
    }
}