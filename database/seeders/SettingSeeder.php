<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('settings')->delete();

        $data = [
            ['key' => 'title', 'value' => 'جمعية الصلاح الخيرية'],
            ['key' => 'phone', 'value' => '5455845'],
            ['key' => 'email', 'value' => 'gg@fgf'],
            ['key' => 'logo', 'value' => '1.jpg'],
            ['key' => 'status', 'value' => 0],
        ];
        DB::table('settings')->insert($data);
    }
}
