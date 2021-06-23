<?php

use Illuminate\Database\Seeder;
use App\Models\Account;
class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        App\Models\Account::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $data=[
            ['name'=>'Tiền mặt'],
            ['name'=>'VNPAY-QR'],
            ['name'=>'VNPAY-POS'],
            ['name'=>'ZALO-PAY'],
        ];
        Account::insert($data);
    }
}
