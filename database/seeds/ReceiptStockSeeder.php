<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\ReceiptStock;
class ReceiptStockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        ReceiptStock::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
        // $data=[

        //     ['code'=>'PX000001','document'=> 'PBH000001','cat_id'=> 4,'child_cat_id'=> 19,'user_id'=> 7, 'supplier_id'=> null, 'quantity'=>5,'total'=>'1037000',  'payment'=>'1037000', 'debt'=>'0','status'=> 'Hoàn thành','created_at'=>'2021-02-01 09:21:32'],
        //     ['code'=>'PX000002','document'=> 'PBH000002','cat_id'=> 4,'child_cat_id'=> 19,'user_id'=> 16, 'supplier_id'=> null, 'quantity'=>5,'total'=>'1037000',  'payment'=>'1037000', 'debt'=>'0','status'=> 'Hoàn thành','created_at'=>'2021-02-02 09:21:48'],
        //     ['code'=>'PX000003','document'=> 'PBH000003','cat_id'=> 4,'child_cat_id'=> 19,'user_id'=> 11, 'supplier_id'=> null, 'quantity'=>5,'total'=>'1037000',  'payment'=>'1037000', 'debt'=>'0','status'=> 'Hoàn thành','created_at'=>'2021-02-03 09:21:52'],
        //     ['code'=>'PX000004','document'=> 'PBH000004','cat_id'=> 4,'child_cat_id'=> 19,'user_id'=> 2, 'supplier_id'=> null, 'quantity'=>5,'total'=>'1037000',  'payment'=>'1037000', 'debt'=>'0','status'=> 'Hoàn thành','created_at'=>'2021-02-04 09:22:03'],
        //     ['code'=>'PX000005','document'=> 'PBH000005','cat_id'=> 4,'child_cat_id'=> 19,'user_id'=> 8, 'supplier_id'=> null, 'quantity'=>5,'total'=>'1037000',  'payment'=>'1037000', 'debt'=>'0','status'=> 'Hoàn thành','created_at'=>'2021-02-05 09:22:08'],
        //     ['code'=>'PX000006','document'=> 'PBH000006','cat_id'=> 4,'child_cat_id'=> 19,'user_id'=> 17, 'supplier_id'=> null, 'quantity'=>5,'total'=>'1037000',  'payment'=>'1037000', 'debt'=>'0','status'=> 'Hoàn thành','created_at'=>'2021-02-06 09:22:12'],
        //     ['code'=>'PX000007','document'=> 'PBH000007','cat_id'=> 4,'child_cat_id'=> 19,'user_id'=> 17, 'supplier_id'=> null, 'quantity'=>5,'total'=>'1037000',  'payment'=>'1037000', 'debt'=>'0','status'=> 'Hoàn thành','created_at'=>'2021-02-07 09:22:16'],
        //     ['code'=>'PX000008','document'=> 'PBH000008','cat_id'=> 4,'child_cat_id'=> 19,'user_id'=> 5, 'supplier_id'=> null, 'quantity'=>5,'total'=>'1037000',  'payment'=>'1037000', 'debt'=>'0','status'=> 'Hoàn thành','created_at'=>'2021-02-08 09:22:20'],
        //     ['code'=>'PX000009','document'=> 'PBH000009','cat_id'=> 4,'child_cat_id'=> 19,'user_id'=> 7, 'supplier_id'=> null, 'quantity'=>5,'total'=>'1037000',  'payment'=>'1037000', 'debt'=>'0','status'=> 'Hoàn thành','created_at'=>'2021-02-09 09:22:26'],
        //     ['code'=>'PX000010','document'=> 'PBH000010','cat_id'=> 4,'child_cat_id'=> 19,'user_id'=> 17, 'supplier_id'=> null, 'quantity'=>5,'total'=>'1037000',  'payment'=>'1037000', 'debt'=>'0','status'=> 'Hoàn thành','created_at'=>'2021-02-10 09:22:31'],
        //     ['code'=>'PX000011','document'=> 'PBH000011','cat_id'=> 4,'child_cat_id'=> 19,'user_id'=> 7, 'supplier_id'=> null, 'quantity'=>5,'total'=>'1037000',  'payment'=>'1037000', 'debt'=>'0','status'=> 'Hoàn thành','created_at'=>'2021-02-11 09:22:35'],
        //     ['code'=> 'PN000001',  'document'=>NULL,  'cat_id'=> 3,'child_cat_id'=> 15,'user_id'=> NULL, 'supplier_id'=>1,'quantity'=> 13,'total'=> 1300000,'payment'=> 1130000,'debt'=> 0, 'status'=>'Hoàn thành', 'created_at'=>'2021-02-28 18:51:38'],
        //     ['code'=> 'PN000002',  'document'=>NULL,  'cat_id'=> 3,'child_cat_id'=> 15,'user_id'=> NULL, 'supplier_id'=>1, 'quantity'=>24,'total'=> 2400000,'payment'=> 2400000, 'debt'=>0, 'status'=>'Hoàn thành', 'created_at'=>'2021-02-28 18:52:11'],
        //      ['code'=> 'PN000005',  'document'=>NULL,  'cat_id'=> 3,'child_cat_id'=> 15,'user_id'=> NULL, 'supplier_id'=>3,'quantity'=> 8, 'total'=>800000, 'payment'=>80000,'debt'=> 0, 'status'=>'Hoàn thành', 'created_at'=>'2021-03-01 02:08:30'],
        //      ['code'=> 'PN000006',  'document'=>NULL,  'cat_id'=> 3,'child_cat_id'=> 15,'user_id'=> NULL, 'supplier_id'=>4,'quantity'=> 20,'total'=> 2000000, 'payment'=>2000000,'debt'=> 0, 'status'=>'Hoàn thành','created_at'=> '2021-03-01 02:14:19'],
        //      ['code'=> 'PN000007',  'document'=>NULL,  'cat_id'=> 3,'child_cat_id'=> 15,'user_id'=> NULL, 'supplier_id'=>4,'quantity'=> 8, 'total'=>800000,'payment'=> 680000,'debt'=> 0, 'status'=>'Hoàn thành','created_at'=> '2021-03-01 02:17:54'],
        //      ['code'=> 'PN000008',  'document'=>NULL,  'cat_id'=> 3,'child_cat_id'=> 15,'user_id'=> NULL, 'supplier_id'=>9,'quantity'=> 6, 'total'=>600000, 'payment'=>600000, 'debt'=>0, 'status'=>'Hoàn thành','created_at'=> '2021-03-01 02:20:30'],
        //      ['code'=> 'PN000009',  'document'=>NULL,  'cat_id'=> 3,'child_cat_id'=> 15,'user_id'=> NULL, 'supplier_id'=>6,'quantity'=> 4,'total'=> 400000, 'payment'=>400000, 'debt'=>0, 'status'=>'Hoàn thành','created_at'=> '2021-03-01 02:25:22'],
        //      ['code'=> 'PN000010',  'document'=>NULL,  'cat_id'=> 3,'child_cat_id'=> 15,'user_id'=> NULL, 'supplier_id'=>2,'quantity'=> 2,'total'=> 200000,'payment'=> 400000,'debt'=> 0, 'status'=>'Hoàn thành','created_at'=> '2021-03-01 02:33:44'],
        //      ['code'=> 'PN000011',  'document'=>NULL,  'cat_id'=> 3,'child_cat_id'=> 15,'user_id'=> NULL, 'supplier_id'=>5,'quantity'=> 7, 'total'=>700000,'payment'=> 700000,'debt'=> 0, 'status'=>'Hoàn thành', 'created_at'=>'2021-03-01 02:36:03'],
        //      ['code'=> 'PN000012',  'document'=>NULL,  'cat_id'=> 3,'child_cat_id'=> 15,'user_id'=> NULL, 'supplier_id'=>3,'quantity'=> 1, 'total'=>100000,'payment'=> 50000,'debt'=> 0, 'status'=>'Hoàn thành', 'created_at'=>'2021-03-01 04:48:27'],
        //     ['code'=> 'PN000013',  'document'=>NULL,  'cat_id'=> 3,'child_cat_id'=> 15,'user_id'=> NULL, 'supplier_id'=>4,'quantity'=> 8, 'total'=>800000,'payment'=> 800000, 'debt'=>0, 'status'=>'Hoàn thành','created_at'=> '2021-03-01 04:49:09'],
        // ];
        // DB::table('receipt_stocks')->insert($data);
    }
}
