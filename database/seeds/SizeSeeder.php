<?php

use Illuminate\Database\Seeder;
use App\Models\Size;
class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Size::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $array=array('S','M','L','XL','XXL');
        foreach($array as $val){
            $data=[
                'size_category_id'=>1,
                'name'=>$val
            ];
            Size::insert($data);
        }
        for($i=35; $i<=42; $i++){
            $data=[
                'size_category_id'=>2,
                'name'=>$i
            ];
            Size::insert($data);
        }
        
    }
}
