<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class RouteShipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data=[
            ['name'=>'Nội tỉnh','description'=>'Hà Nội <-> Hà Nội,Đà Nẵng <-> Đà Nẵng,Hồ Chí Minh <-> Hồ Chí Minh,Tỉnh X vùng 1 <-> Tỉnh X vùng 1,Tỉnh X vùng 2 <-> Tỉnh X vùng 2,Tỉnh X vùng 3 <-> Tỉnh X vùng 3','note'=>'Vùng 1: Các tỉnh miền Nam,Vùng 2: Các tỉnh miền Trung,Vùng 3: Các tỉnh miền Bắc'],
            ['name'=>'Nội vùng','description'=>'Hà Nội <-> Vùng 3,Đà Nẵng <-> Vùng 2,Hồ Chí Minh <-> Vùng 1','note'=>null],
            ['name'=>'Nội vùng tỉnh','description'=>'Vùng 3 <-> Vùng 3,Vùng 2 <-> Vùng 2,Vùng 1 <-> Vùng 1','note'=>null],
            ['name'=>'Liên vùng đặc biệt','description'=>'Hà Nội <-> Đà Nẵng,Đà Nẵng <-> Hồ Chí Minh,Hồ Chí Minh <-> Hà Nội','note'=>null],
            ['name'=>'Liên vùng','description'=>'Hà Nội <-> Vùng 1/Vùng 2,Đà Nẵng <-> Vùng 1/Vùng 3,Hồ Chí Minh <-> Vùng 2/Vùng 3','note'=>null],
            ['name'=>'Liên vùng tỉnh','description'=>'Vùng 3 <-> Vùng 1/Vùng 2,Vùng 2 <-> Vùng 1/Vùng 3,Vùng 1 <-> Vùng 2/Vùng 3','note'=>null],
        ];
        DB::table('route_ships')->insert($data);
    }
}
