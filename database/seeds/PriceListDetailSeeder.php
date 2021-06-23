<?php

use Illuminate\Database\Seeder;
use App\Models\PriceListDetail;
class PriceListDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        PriceListDetail::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        for($i=1; $i<=30; $i++){
            $data=[
                ['price_list_id'=>1,'product_id'=>$i,'cost_price'=>100000,'on_price'=>150000,'off_price'=>140000]
            ];
            PriceListDetail::insert($data);

        }
        
    }
}
