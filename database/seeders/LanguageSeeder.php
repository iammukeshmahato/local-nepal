<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Language;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $languages = [
            ['name' => 'English'],
            ['name' => 'Nepali'],
            ['name' => 'Hindi'],
            ['name' => 'Maithili'],
            ['name' => 'French'],
            ['name' => 'Spanish'],
            ['name' => 'German'],
            ['name' => 'Italian'],
            ['name' => 'Chinese'],
            ['name' => 'Japanese'],
            ['name' => 'Arabic'],
            ['name' => 'Russian'],
            ['name' => 'Portuguese'],
            // Add more languages if needed
        ];

        Language::insert($languages);
    }
}
