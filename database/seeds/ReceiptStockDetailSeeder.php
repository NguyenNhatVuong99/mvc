<?php

use Illuminate\Database\Seeder;

class ReceiptStockDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        App\Models\ReceiptStockDetail::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        //
    }
}
