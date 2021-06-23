<?php

use Illuminate\Database\Seeder;
use App\Models\PriceList;
class PriceListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        PriceList::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $data=[
            ['title'=>'Bảng giá niêm yết','default'=>1,'status'=>1]
        ];
        PriceList::insert($data);
    }
}
