<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Partner;
class PartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        App\Models\Partner::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $data=[
            ['name'=>'Khách hàng','slug'=>'khach-hang'],
            ['name'=>'Nhà cung cấp','slug'=>'nha-cung-cap'],
            ['name'=>'Đối tác giao hàng','slug'=>'doi-tac-giao-hang'],
            ['name'=>'Khác','slug'=>'khác'],
        ];
        DB::table('partners')->insert($data);
    }
}
