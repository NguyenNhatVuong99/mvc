<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShippingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        App\Models\Shipping::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $data=[
            'name'=>'Giao hàng nhanh',
            'name'=>'Giao hàng tiết kiệm',
            'name'=>'Viettel Post',
        ];
        DB::table('shippings')->insert($data);
    }
}
