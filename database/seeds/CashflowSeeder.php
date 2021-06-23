<?php

use Illuminate\Database\Seeder;

class CashflowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        App\Models\Cashflow::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
