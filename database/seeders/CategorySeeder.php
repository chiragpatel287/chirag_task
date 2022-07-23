<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
        [
            'name' => 'Personal',
            'created_at' => date('Y-m-d h:i:s')
        ],
        [
            'name' => 'Business/corporate',
            'created_at' => date('Y-m-d h:i:s')
        ],
        [
            'name' => 'Personal brand/professional',
            'created_at' => date('Y-m-d h:i:s')
        ],
        [
            'name' => 'Fashion',
            'created_at' => date('Y-m-d h:i:s')
        ],
        [
            'name' => 'Lifestyle',
            'created_at' => date('Y-m-d h:i:s')
        ],
        [
            'name' => 'Travel',
            'created_at' => date('Y-m-d h:i:s')
        ]
        ]);
    }
}
