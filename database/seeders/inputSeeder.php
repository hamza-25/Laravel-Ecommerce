<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class inputSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            "name"=>Str::random(10),
            "description"=>Str::random(10),
            "price"=>random_int(1,50),
            "size"=>"M",
            "qty"=>random_int(1,50),
            "image"=>'https://m.media-amazon.com/images/I/612POrS7WnL._AC_UX425_.jpg',
            "category_id"=>random_int(1,3)
        ]);
    }
}
