<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class DetailOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1; $i<=11; $i++){
            $data=[
                ['product_id'=>30, 'order_id'=>$i, 'price'=>200000, 'quantity'=>1, 'amount'=>200000],
                ['product_id'=>29, 'order_id'=>$i, 'price'=>200000, 'quantity'=>1, 'amount'=>200000],
                ['product_id'=>28, 'order_id'=>$i, 'price'=>200000, 'quantity'=>2, 'amount'=>400000],
                ['product_id'=>27, 'order_id'=>$i, 'price'=>200000, 'quantity'=>1, 'amount'=>200000],
            ];
            DB::table('detail_orders')->insert($data);
        }
        
            
    }
}
