<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public static $seeders = [];
    public function run()
    {
        ksort(self::$seeders);
        foreach (self::$seeders as $seeder) {
            $this->call($seeder);
        }
    }
}
