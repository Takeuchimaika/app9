<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompaniesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('Companies')->insert([
            [
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null,
                'id' => 1,
                'company_name' => 'コカコーラ',
                'street_address' => '京都',
                'representative_name' => 'いわもと',
            
            ],
            [
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null,
                'id' => 2,
                'company_name' => '伊藤園',
                'street_address' => '大阪',
                'representative_name' => 'たなか',
            
            ],
            [
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null,
                'id' => 3,
                'company_name' => 'キリン',
                'street_address' => '東京',
                'representative_name' => 'さがわ',
            
            ],
        ]);
       
        //
    }
}
