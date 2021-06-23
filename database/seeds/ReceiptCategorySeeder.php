<?php

use Illuminate\Database\Seeder;
use App\Models\ReceiptCategory;
class ReceiptCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        ReceiptCategory::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $data=[
            ['code'=>'PT','name'=> 'Phiếu Thu','slug'=>'phieu-thu','is_parent'=> 1, 'parent_id'=>NULL, 'status'=>'1'],
            ['code'=>'PC','name'=> 'Phiếu Chi','slug'=>'phieu-chi', 'is_parent'=>1,'parent_id'=> NULL, 'status'=>'1'],
            ['code'=>'PN','name'=> 'Phiếu Nhập','slug'=>'phieu-nhap', 'is_parent'=>1,'parent_id'=> NULL, 'status'=>'1'],
            ['code'=>'PX','name'=> 'Phiếu Xuất','slug'=>'phieu-xuat', 'is_parent'=>1,'parent_id'=> NULL, 'status'=>'1'],
           
        ];
        DB::table('receipt_categories')->insert($data);
        $data=[
            ['name'=> 'Thu đơn hàng','slug'=>'thu-don-hang','is_parent'=> 0,'parent_id'=> 1, 'status'=>'1'],
            ['name'=> 'Thu tạm ứng','slug'=>'thu-tam-ung', 'is_parent'=>0,'parent_id'=> 1, 'status'=>'1'],
            ['name'=> 'Thu góp vốn','slug'=>'thu-gop-von','is_parent'=> 0,'parent_id'=> 1, 'status'=>'1'],
            ['name'=> 'Thu trả hàng','slug'=>'thu-tra-hang', 'is_parent'=>0, 'parent_id'=>1, 'status'=>'1'],
            ['name'=> 'Thu khác','slug'=>'thu-khac', 'is_parent'=>0,'parent_id'=> 1, 'status'=>'1'],
            ['name'=> 'Chi phí','slug'=>'chi-phi','is_parent'=> 0,'parent_id'=> 2, 'status'=>'1'],
            ['name'=> 'Chi nhập hàng','slug'=>'chi-nhap-hang','is_parent'=> 0,'parent_id'=> 2, 'status'=>'1'],
            ['name'=> 'Chi nợ nhập hàng','slug'=>'chi-no','is_parent'=> 0,'parent_id'=> 2, 'status'=>'1'],
            ['name'=> 'Chi tạm ứng','slug'=>'chi-tam-ung', 'is_parent'=>0,'parent_id'=> 2, 'status'=>'1'],
            ['name'=> 'Chi rút vốn','slug'=>'chi-rut-von ','is_parent'=> 0, 'parent_id'=>2, 'status'=>'1'],
            ['name'=> 'Chi khác', 'slug'=>'chi-chi-khac','is_parent'=>0,'parent_id'=> 2, 'status'=>'1'],
            ['name'=> 'Nhập hàng','slug'=>'nhap-hang', 'is_parent'=>0,'parent_id'=> 3, 'status'=>'1'],
            ['name'=> 'Trả hàng','slug'=>'tra-hang', 'is_parent'=>0,'parent_id'=> 3, 'status'=>'1'],
            ['name'=> 'Chuyển kho','slug'=>'chuyen-kho', 'is_parent'=>0,'parent_id'=> 4, 'status'=>'1'],
            ['name'=> 'Bán lẻ','slug'=>'ban-le', 'is_parent'=>0,'parent_id'=> 4, 'status'=>'1'],
            ['name'=> 'Bán sỉ','slug'=>'ban-si', 'is_parent'=>0,'parent_id'=> 4, 'status'=>'1'],
            ['name'=> 'Khác','slug'=>'khac', 'is_parent'=>0,'parent_id'=> 4, 'status'=>'1'],
            
        ];
        DB::table('receipt_categories')->insert($data);
    }
}
