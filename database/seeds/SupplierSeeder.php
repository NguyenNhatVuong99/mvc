<?php

use Illuminate\Database\Seeder;
use App\Models\Supplier;
use Buihuycuong\Vnfaker\VNFaker;
class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Supplier::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        for($i = 1; $i <=5; $i++) {
            $data=[
                'code'=>'NCC0000'.$i,
                'name' => vnfaker()->company(),
                'phone'=>vnfaker()->mobilephone($numbers = 10),
                'address'=>vnfaker()->city($array = false),
               
            ];
            Supplier::create($data);
        }
    }
}
