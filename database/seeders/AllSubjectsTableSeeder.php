<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AllSubjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subjects = [
            ['code' => '1303', 'name' => 'English Home Language (HL)'],
            ['code' => '1301', 'name' => 'Afrikaans Home Language (HL)'],
            ['code' => '1319', 'name' => 'IsiZulu Home Language (HL)'],
            ['code' => '1403', 'name' => 'English First Additional Language (FAL)'],
            ['code' => '1401', 'name' => 'Afrikaans First Additional Language (FAL)'],
            ['code' => '1419', 'name' => 'IsiZulu First Additional Language (FAL)'],
            ['code' => '1501', 'name' => 'Mathematics'],
            ['code' => '1511', 'name' => 'Mathematical Literacy'],
            ['code' => '1601', 'name' => 'Physical Sciences'],
            ['code' => '1701', 'name' => 'Life Sciences'],
            ['code' => '1801', 'name' => 'Geography'],
            ['code' => '1901', 'name' => 'History'],
            ['code' => '2001', 'name' => 'Accounting'],
            ['code' => '2101', 'name' => 'Business Studies'],
            ['code' => '2201', 'name' => 'Economics'],
            ['code' => '2301', 'name' => 'Visual Arts'],
            ['code' => '2401', 'name' => 'Music'],
            ['code' => '2501', 'name' => 'Dramatic Arts'],
            ['code' => '2601', 'name' => 'Information Technology'],
            ['code' => '2701', 'name' => 'Computer Applications Technology (CAT)'],
            ['code' => '2801', 'name' => 'Engineering Graphics and Design (EGD)'],
            ['code' => '2901', 'name' => 'Consumer Studies'],
            ['code' => '3001', 'name' => 'Hospitality Studies'],
            ['code' => '3101', 'name' => 'Tourism'],
        ];

        DB::table('subjects')->insert($subjects);
    }
}
