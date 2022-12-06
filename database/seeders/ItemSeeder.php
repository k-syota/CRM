<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('items')->insert([
            [
                'name' => '学生カット',
                'memo' => '学生向けカット',
                'price' => 3000
            ],
            [
                'name' => '一般カット',
                'memo' => 'カットの詳細',
                'price' => 6000
            ],
            [
                'name' => 'カラー',
                'memo' => 'カラーの詳細',
                'price' => 8000
            ],
            [
                'name' => 'パーマ',
                'memo' => 'パーマの詳細',
                'price' => 13000
            ]
        ]);
    }
}
