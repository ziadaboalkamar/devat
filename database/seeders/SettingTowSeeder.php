<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingTowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings_tow')->delete();

        $data = [
            ['key' => 'title', 'value' => 'جمعية الايتام '],
            ['key' => 'phone', 'value' => '4545488'],
            ['key' => 'email', 'value' => 'xx@flg'],
            ['key' => 'logo', 'value' => '2.jpg'],
            ['key' => 'status', 'value' => 1],
        ];
        DB::table('settings_tow')->insert($data);
    }
}
