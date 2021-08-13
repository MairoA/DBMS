<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'first_name' =>  'Alagba',
            'last_name' =>  'Mairo',
            'email' =>  'mairo4real@gmail.com',
            'password' => \Hash::make('123abc'),
            'role' =>  'Admin',
        ]);

        DB::table('sessions')->insert([
            ['session' =>  '2010/2011'],
            ['session' =>  '2011/2012'],
            ['session' =>  '2012/2013'],
            ['session' =>  '2013/2014'],
            ['session' =>  '2014/2015'],
            ['session' =>  '2015/2016'],
            ['session' =>  '2016/2017'],
            ['session' =>  '2017/2018'],
            ['session' =>  '2018/2019'],
            ['session' =>  '2019/2020'],
            ['session' =>  '2020/2021'],
            ['session' =>  '2021/2022'],
            ['session' =>  '2022/2023'],
            ['session' =>  '2023/2024'],
            ['session' =>  '2024/2025']
        ]);
    }
}
