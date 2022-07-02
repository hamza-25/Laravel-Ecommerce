<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class orderseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('orders')->insert([
            "order_num" => Str::random(30),
            "user_id" => 1,
            'price'=>19.99,
            "qty"=>100,
            "product_id" => random_int(2, 5),
            "address_id" => 12

        ]);
    }
}
