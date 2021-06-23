<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceShipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data=[
            ['route_ship_id'=>'1','method'=>'Đường bộ','weight'=>3000,'urban'=>22000,'suburban'=>35000,'more_weight'=>4000,'time'=>'1'],
            ['route_ship_id'=>'2','method'=>'Đường bộ','weight'=>1000,'urban'=>37000,'suburban'=>47000,'more_weight'=>7000,'time'=>'2'],
            ['route_ship_id'=>'3','method'=>'Đường bộ','weight'=>1000,'urban'=>37000,'suburban'=>47000,'more_weight'=>7000,'time'=>'3'],
            ['route_ship_id'=>'4','method'=>'Đường hàng không','weight'=>1000,'urban'=>59000,'suburban'=>69000,'more_weight'=>10000,'time'=>'3'],
            ['route_ship_id'=>'4','method'=>'Đường bộ','weight'=>1000,'urban'=>37000,'suburban'=>47000,'more_weight'=>8000,'time'=>'3'],
            ['route_ship_id'=>'5','method'=>'Đường hàng không','weight'=>1000,'urban'=>59000,'suburban'=>69000,'more_weight'=>10000,'time'=>'4'],
            ['route_ship_id'=>'5','method'=>'Đường bộ','weight'=>1000,'urban'=>37000,'suburban'=>47000,'more_weight'=>8000,'time'=>'5'],
            ['route_ship_id'=>'6','method'=>'Đường hàng không','weight'=>1000,'urban'=>59000,'suburban'=>69000,'more_weight'=>10000,'time'=>'4'],
            ['route_ship_id'=>'6','method'=>'Đường bộ','weight'=>1000,'urban'=>37000,'suburban'=>47000,'more_weight'=>8000,'time'=>'5'],
        ];
        DB::table('service_ships')->insert($data);
    }
}
