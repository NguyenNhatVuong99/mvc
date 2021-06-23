<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data=[
            ['name'=>'Chờ bàn giao'],
            ['name'=>'Đã bàn giao - Đang giao'],
            ['name'=>'Đã bàn giao - Đang hoàn hàng'],
            ['name'=>'Chờ xác nhận giao lại'],
            ['name'=>'Hoàn tất'],
            ['name'=>'Đơn hủy'],
            ['name'=>'Hàng thất lạc - hư hỏng'],
        ];
        DB::table('status_orders')->insert($data);
    }
}
