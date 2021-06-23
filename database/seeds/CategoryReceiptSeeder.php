<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\CategoryReceipt;
class CategoryReceiptSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        CategoryReceipt::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $data=[
            ['code'=>'PT','name'=> 'Phiếu Thu','slug'=>'phieu-thu','is_parent'=> 1, 'parent_id'=>NULL, 'status'=>'active'],
            ['code'=>'PC','name'=> 'Phiếu Chi','slug'=>'phieu-chi', 'is_parent'=>1,'parent_id'=> NULL, 'status'=>'active'],
            ['code'=>'PN','name'=> 'Phiếu Nhập','slug'=>'phieu-nhap', 'is_parent'=>1,'parent_id'=> NULL, 'status'=>'active'],
            ['code'=>'PX','name'=> 'Phiếu Xuất','slug'=>'phieu-xuat', 'is_parent'=>1,'parent_id'=> NULL, 'status'=>'active'],
           
        ];
        DB::table('category_receipts')->insert($data);
        $data=[
            ['name'=> 'Thu đơn hàng','slug'=>'thu-don-hang','is_parent'=> 0,'parent_id'=> 1, 'status'=>'active'],
            ['name'=> 'Thu tạm ứng','slug'=>'thu-tam-ung', 'is_parent'=>0,'parent_id'=> 1, 'status'=>'active'],
            ['name'=> 'Thu góp vốn','slug'=>'thu-gop-von','is_parent'=> 0,'parent_id'=> 1, 'status'=>'active'],
            ['name'=> 'Thu trả hàng','slug'=>'thu-tra-hang', 'is_parent'=>0, 'parent_id'=>1, 'status'=>'active'],
            ['name'=> 'Thu khác','slug'=>'thu-khac', 'is_parent'=>0,'parent_id'=> 1, 'status'=>'active'],
            ['name'=> 'Chi phí','slug'=>'chi-phi','is_parent'=> 0,'parent_id'=> 2, 'status'=>'active'],
            ['name'=> 'Chi nhập hàng','slug'=>'chi-nhap-hang','is_parent'=> 0,'parent_id'=> 2, 'status'=>'active'],
            ['name'=> 'Chi nợ nhập hàng','slug'=>'chi-no','is_parent'=> 0,'parent_id'=> 2, 'status'=>'active'],
            ['name'=> 'Chi tạm ứng','slug'=>'chi-tam-ung', 'is_parent'=>0,'parent_id'=> 2, 'status'=>'active'],
            ['name'=> 'Chi rút vốn','slug'=>'chi-rut-von ','is_parent'=> 0, 'parent_id'=>2, 'status'=>'active'],
            ['name'=> 'Chi khác', 'slug'=>'chi-chi-khac','is_parent'=>0,'parent_id'=> 2, 'status'=>'active'],
            ['name'=> 'Nhập hàng','slug'=>'nhap-hang', 'is_parent'=>0,'parent_id'=> 3, 'status'=>'active'],
            ['name'=> 'Trả hàng','slug'=>'tra-hang', 'is_parent'=>0,'parent_id'=> 3, 'status'=>'active'],
            ['name'=> 'Chuyển kho','slug'=>'chuyen-kkho', 'is_parent'=>0,'parent_id'=> 4, 'status'=>'active'],
            ['name'=> 'Bán lẻ','slug'=>'ban-le', 'is_parent'=>0,'parent_id'=> 4, 'status'=>'active'],
            ['name'=> 'Bán sỉ','slug'=>'ban-si', 'is_parent'=>0,'parent_id'=> 4, 'status'=>'active'],
            ['name'=> 'Khác','slug'=>'khac', 'is_parent'=>0,'parent_id'=> 4, 'status'=>'active'],
            
        ];
        DB::table('category_receipts')->insert($data);
    }
}
