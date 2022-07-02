<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
class addressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('addresses')->insert([
            "full_name" => "yassin",
            "country" => "morocco",
            "city" => "casa",
            "province" => 'casa',
            "phone" => "+212653958546856",
            "address" => "quartien waheda casa",
            "zipcode" => "46856",
            "user_id" =>2
        ]);

    }
}
