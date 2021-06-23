<?php

use Illuminate\Database\Seeder;
use App\Models\Stock;
use Illuminate\Support\Facades\DB;
class StockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Stock::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        for($i=1; $i<31; $i++){
            $data=[
                ['product_id'=>$i,'branch_id'=>1,'quantity'=>'0','isWarning'=>1],
                ['product_id'=>$i,'branch_id'=>2,'quantity'=>'0','isWarning'=>1],
                ['product_id'=>$i,'branch_id'=>3,'quantity'=>'0','isWarning'=>1],
            ];
            Stock::insert($data);
        }
    }
}
