<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data=[

            ['order_code'=>'PBH000001','user_id'=> 7,'profile_id'=> 1,'sub_price'=> 1000000,'type'=>'Online','coupon'=> 0,'fee_ship'=> 37000,'total_price'=> 1037000, 'quantity'=> 5, 'giveFriend'=>'false','payments'=>'Tiền mặt',  'service_name'=>'Đường bộ', 'delivery_time'=>'T6, 5 Th02 2021 1','status_id'=> 5,'created_at'=>'2020-12-07 09:21:32'],
            ['order_code'=>'PBH000002','user_id'=> 16,'profile_id'=> 2,'sub_price'=> 1000000,'type'=>'Online','coupon'=> 0,'fee_ship'=> 37000,'total_price'=> 1037000, 'quantity'=> 5, 'giveFriend'=>'false','payments'=>'Tiền mặt',  'service_name'=>'Đường bộ', 'delivery_time'=>'T6, 5 Th02 2021 1','status_id'=> 5,'created_at'=>'2021-03-01 09:21:48'],
            ['order_code'=>'PBH000003','user_id'=> 11,'profile_id'=> 3,'sub_price'=> 1000000,'type'=>'Online','coupon'=> 0,'fee_ship'=> 37000,'total_price'=> 1037000, 'quantity'=> 5, 'giveFriend'=>'false','payments'=>'Tiền mặt',  'service_name'=>'Đường bộ', 'delivery_time'=>'T6, 5 Th02 2021 1','status_id'=> 5,'created_at'=>'2021-02-01 09:21:52'],
            ['order_code'=>'PBH000004','user_id'=> 2,'profile_id'=> 4,'sub_price'=> 1000000,'type'=>'Online','coupon'=> 0,'fee_ship'=> 37000,'total_price'=> 1037000, 'quantity'=> 5, 'giveFriend'=>'false','payments'=>'Tiền mặt',  'service_name'=>'Đường bộ', 'delivery_time'=>'T6, 5 Th02 2021 1','status_id'=> 5,'created_at'=>'2021-02-16 09:22:03'],
            ['order_code'=>'PBH000005','user_id'=> 8,'profile_id'=> 5,'sub_price'=> 1000000,'type'=>'Online','coupon'=> 0,'fee_ship'=> 37000,'total_price'=> 1037000, 'quantity'=> 5, 'giveFriend'=>'false','payments'=>'Tiền mặt',  'service_name'=>'Đường bộ', 'delivery_time'=>'T6, 5 Th02 2021 1','status_id'=> 5,'created_at'=>'2021-02-23 09:22:08'],
            ['order_code'=>'PBH000006','user_id'=> 17,'profile_id'=> 6,'sub_price'=> 1000000,'type'=>'Online','coupon'=> 0,'fee_ship'=> 37000,'total_price'=> 1037000, 'quantity'=> 5, 'giveFriend'=>'false','payments'=>'Tiền mặt',  'service_name'=>'Đường bộ', 'delivery_time'=>'T6, 5 Th02 2021 1','status_id'=> 5,'created_at'=>'2021-02-24 09:22:12'],
            ['order_code'=>'PBH000007','user_id'=> 17,'profile_id'=> 5,'sub_price'=> 1000000,'type'=>'Online','coupon'=> 0,'fee_ship'=> 37000,'total_price'=> 1037000, 'quantity'=> 5, 'giveFriend'=>'false','payments'=>'Tiền mặt',  'service_name'=>'Đường bộ', 'delivery_time'=>'T6, 5 Th02 2021 1','status_id'=> 5,'created_at'=>'2021-02-15 09:22:16'],
            ['order_code'=>'PBH000008','user_id'=> 5,'profile_id'=> 4,'sub_price'=> 1000000,'type'=>'Online','coupon'=> 0,'fee_ship'=> 37000,'total_price'=> 1037000, 'quantity'=> 5, 'giveFriend'=>'false','payments'=>'Tiền mặt',  'service_name'=>'Đường bộ', 'delivery_time'=>'T6, 5 Th02 2021 1','status_id'=> 5,'created_at'=>'2021-02-02 09:22:20'],
            ['order_code'=>'PBH000009','user_id'=> 7,'profile_id'=> 3,'sub_price'=> 1000000,'type'=>'Online','coupon'=> 0,'fee_ship'=> 37000,'total_price'=> 1037000, 'quantity'=> 5, 'giveFriend'=>'false','payments'=>'Tiền mặt',  'service_name'=>'Đường bộ', 'delivery_time'=>'T6, 5 Th02 2021 1','status_id'=> 5,'created_at'=>'2021-02-15 09:22:26'],
            ['order_code'=>'PBH000010','user_id'=> 17,'profile_id'=> 2,'sub_price'=> 1000000,'type'=>'Online','coupon'=> 0,'fee_ship'=> 37000,'total_price'=> 1037000, 'quantity'=> 5, 'giveFriend'=>'false','payments'=>'Tiền mặt',  'service_name'=>'Đường bộ', 'delivery_time'=>'T6, 5 Th02 2021 1','status_id'=> 5,'created_at'=>'2021-02-09 09:22:31'],
            ['order_code'=>'PBH000011','user_id'=> 7,'profile_id'=> 6,'sub_price'=> 1000000,'type'=>'Online','coupon'=> 0,'fee_ship'=> 37000,'total_price'=> 1037000, 'quantity'=> 5, 'giveFriend'=>'false','payments'=>'Tiền mặt',  'service_name'=>'Đường bộ', 'delivery_time'=>'T6, 5 Th02 2021 1','status_id'=> 5,'created_at'=>'2021-02-09 09:22:35'],
        ];
        DB::table('orders')->insert($data);
    }
}
