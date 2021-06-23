<?php

use Illuminate\Database\Seeder;
use App\Models\SizeCategory;
class SizeCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        SizeCategory::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $data=[
            ['name'=>'size áo'],
            ['name'=>'size giày'],
        ];
        SizeCategory::insert($data);
    }
}
