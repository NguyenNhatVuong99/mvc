<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class DetailReceiptStockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        App\Models\DetailReceiptStockSeeder::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $data=[

            ['code'=>'PX000001','date'=> 1,'receipt'=> 'PBH000001','receipt_date'=>'Online','cat_id'=> 4,'child_cat_id'=> 19,'user_id'=> 7, 'supplier_id'=> null, 'quantity'=>5,'total'=>'1037000',  'payment'=>'1037000', 'debt'=>'0','status'=> 'Hoàn thành','created_at'=>'2020-12-07 09:21:32'],
            ['code'=>'PX000002','date'=> 1,'receipt'=> 'PBH000002','receipt_date'=>'Online','cat_id'=> 4,'child_cat_id'=> 19,'user_id'=> 16, 'supplier_id'=> null, 'quantity'=>5,'total'=>'1037000',  'payment'=>'1037000', 'debt'=>'0','status'=> 'Hoàn thành','created_at'=>'2021-03-01 09:21:48'],
            ['code'=>'PX000003','date'=> 1,'receipt'=> 'PBH000003','receipt_date'=>'Online','cat_id'=> 4,'child_cat_id'=> 19,'user_id'=> 11, 'supplier_id'=> null, 'quantity'=>5,'total'=>'1037000',  'payment'=>'1037000', 'debt'=>'0','status'=> 'Hoàn thành','created_at'=>'2021-02-01 09:21:52'],
            ['code'=>'PX000004','date'=> 1,'receipt'=> 'PBH000004','receipt_date'=>'Online','cat_id'=> 4,'child_cat_id'=> 19,'user_id'=> 2, 'supplier_id'=> null, 'quantity'=>5,'total'=>'1037000',  'payment'=>'1037000', 'debt'=>'0','status'=> 'Hoàn thành','created_at'=>'2021-02-16 09:22:03'],
            ['code'=>'PX000005','date'=> 1,'receipt'=> 'PBH000005','receipt_date'=>'Online','cat_id'=> 4,'child_cat_id'=> 19,'user_id'=> 8, 'supplier_id'=> null, 'quantity'=>5,'total'=>'1037000',  'payment'=>'1037000', 'debt'=>'0','status'=> 'Hoàn thành','created_at'=>'2021-02-23 09:22:08'],
            ['code'=>'PX000006','date'=> 1,'receipt'=> 'PBH000006','receipt_date'=>'Online','cat_id'=> 4,'child_cat_id'=> 19,'user_id'=> 17, 'supplier_id'=> null, 'quantity'=>5,'total'=>'1037000',  'payment'=>'1037000', 'debt'=>'0','status'=> 'Hoàn thành','created_at'=>'2021-02-24 09:22:12'],
            ['code'=>'PX000007','date'=> 1,'receipt'=> 'PBH000007','receipt_date'=>'Online','cat_id'=> 4,'child_cat_id'=> 19,'user_id'=> 17, 'supplier_id'=> null, 'quantity'=>5,'total'=>'1037000',  'payment'=>'1037000', 'debt'=>'0','status'=> 'Hoàn thành','created_at'=>'2021-02-15 09:22:16'],
            ['code'=>'PX000008','date'=> 1,'receipt'=> 'PBH000008','receipt_date'=>'Online','cat_id'=> 4,'child_cat_id'=> 19,'user_id'=> 5, 'supplier_id'=> null, 'quantity'=>5,'total'=>'1037000',  'payment'=>'1037000', 'debt'=>'0','status'=> 'Hoàn thành','created_at'=>'2021-02-02 09:22:20'],
            ['code'=>'PX000009','date'=> 1,'receipt'=> 'PBH000009','receipt_date'=>'Online','cat_id'=> 4,'child_cat_id'=> 19,'user_id'=> 7, 'supplier_id'=> null, 'quantity'=>5,'total'=>'1037000',  'payment'=>'1037000', 'debt'=>'0','status'=> 'Hoàn thành','created_at'=>'2021-02-15 09:22:26'],
            ['code'=>'PX000010','date'=> 1,'receipt'=> 'PBH000010','receipt_date'=>'Online','cat_id'=> 4,'child_cat_id'=> 19,'user_id'=> 17, 'supplier_id'=> null, 'quantity'=>5,'total'=>'1037000',  'payment'=>'1037000', 'debt'=>'0','status'=> 'Hoàn thành','created_at'=>'2021-02-09 09:22:31'],
            ['code'=>'PX000011','date'=> 1,'receipt'=> 'PBH000011','receipt_date'=>'Online','cat_id'=> 4,'child_cat_id'=> 19,'user_id'=> 7, 'supplier_id'=> null, 'quantity'=>5,'total'=>'1037000',  'payment'=>'1037000', 'debt'=>'0','status'=> 'Hoàn thành','created_at'=>'2021-02-09 09:22:35'],
            ['code'=>'PX000012','date'=> 1,'receipt'=> 'PBH000012','receipt_date'=>'Online','cat_id'=> 4,'child_cat_id'=> 19,'user_id'=> 11, 'supplier_id'=> null, 'quantity'=>2,'total'=>'437000',  'payment'=>'0', 'debt'=>'437000','status'=> 'Chờ xuất kho','created_at'=>'2021-03-02 09:13:27'],
            ['code'=>'PX000013','date'=> 1,'receipt'=> 'PBH000013','receipt_date'=>'Online','cat_id'=> 4,'child_cat_id'=> 19,'user_id'=> 5, 'supplier_id'=> null, 'quantity'=>1,'total'=>'237000',  'payment'=>'0', 'debt'=>'237000','status'=> 'Chờ xuất kho','created_at'=>'2021-03-02 09:15:28'],
            ['code'=>'PX000014','date'=> 1,'receipt'=> 'PBH000014','receipt_date'=>'Online','cat_id'=> 4,'child_cat_id'=> 19,'user_id'=> 2, 'supplier_id'=> null, 'quantity'=>1,'total'=>'237000',  'payment'=>'0', 'debt'=>'237000','status'=> 'Chờ xuất kho','created_at'=>'2021-03-02 09:17:44'],
        ];
        DB::table('receipt_stocks')->insert($data);
    }
}

