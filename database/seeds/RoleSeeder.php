<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;
use Illuminate\Support\Facades\DB;
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Role::truncate();
        Permission::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $data=[
            ['name'=>'Admin','slug'=>'admin','guard_name'=>'web','description'=>'Quản trị viên cấp cao. Có quyền truy cập và toàn quyền vào tất cả các trang.','code'=>'AD','isPersonel'=>0,'isTimesheet'=>0],
            ['name'=>'Thu ngân','slug'=>'thu-ngan','guard_name'=>'web','description'=>'Thu ngân cửa hàng. Có quyền truy cập trang bán hàng và quản lý thu chi trong ca','code'=>'TN','isPersonel'=>1,'isTimesheet'=>1],
            ['name'=>'Khách hàng','slug'=>'khach-hang','guard_name'=>'web','description'=>'Khách hàng có quyền truy cập vào trang cá nhân riêng','code'=>'KH','isPersonel'=>0,'isTimesheet'=>0],
            ['name'=>'Khách vãng lai','slug'=>'khach-vang-lai','guard_name'=>'web','description'=>'Khách hàng không có quyền truy cập bất kỳ trang nào','code'=>'KVL','isPersonel'=>0,'isTimesheet'=>0],
        ];
        DB::table('roles')->insert($data);
        $data=[
            ['name' => 'Quản lý chi nhánh','guard_name'=>'web'],
            ['name' => 'Quản lý quyền truy cập','guard_name'=>'web'],
            ['name' => 'Quản lý người dùng','guard_name'=>'web'],
            ['name' => 'Xem người dùng','guard_name'=>'web'],
            ['name' => 'Bán hàng','guard_name'=>'web'],
            ['name' => 'Quản lý kho','guard_name'=>'web']
        ];
        DB::table('permissions')->insert($data);
        
        // $user=User::find(1);
        // $user->assignRole('Admin');
        // $user=User::find(2);
        // $user->assignRole('manager');
        // $k1=range(1);
        $k2=range(2,4);
        $k3=range(5,13);
        $k4=range(14,31);
        $k5=range(31,46);
        $k6=range(46,61);
        $k7=range(62,80);
        // $k8=range(81);
        for($i=1; $i<=14;$i++){
            switch (true) {
                case ($i==1):
                    $str='Admin';
                    break;
               
                case in_array($i, $k2):
                    $str='Thu ngân';
                    break;
                case in_array($i, $k3):
                    $str='Khách hàng';
                    break;
                case ($i==14):
                    $str='Khách vãng lai';
                    break;
                    
                
            }
            $user=User::find($i);
            $user->assignRole($str);
        };
        
        // $data=[
        //     ['permission_id'=>1,'role_id'=>1],
        //     ['permission_id'=>2,'role_id'=>1],
        //     ['permission_id'=>3,'role_id'=>1],
        //     ['permission_id'=>4,'role_id'=>2],
        //     ['permission_id'=>5,'role_id'=>2],
        //     ['permission_id'=>6,'role_id'=>2],
        // ];
        // DB::table('role_has_permissions')->insert($data);
        // $data=[
        //     ['permission_id'=>1,'model_id'=>1,'model_type'=>'App\User'],
        //     ['permission_id'=>2,'model_id'=>1,'model_type'=>'App\User'],
        //     ['permission_id'=>3,'model_id'=>1,'model_type'=>'App\User'],
        //     ['permission_id'=>4,'model_id'=>2,'model_type'=>'App\User'],
        //     ['permission_id'=>4,'model_id'=>3,'model_type'=>'App\User'],
        //     ['permission_id'=>4,'model_id'=>4,'model_type'=>'App\User'],
        //     ['permission_id'=>5,'model_id'=>2,'model_type'=>'App\User'],
        //     ['permission_id'=>5,'model_id'=>3,'model_type'=>'App\User'],
        //     ['permission_id'=>5,'model_id'=>4,'model_type'=>'App\User'],
        //     ['permission_id'=>6,'model_id'=>2,'model_type'=>'App\User'],
        //     ['permission_id'=>6,'model_id'=>3,'model_type'=>'App\User'],
        //     ['permission_id'=>6,'model_id'=>4,'model_type'=>'App\User'],
        // ];
        // DB::table('model_has_permissions')->insert($data);

        // for($i=6; $i<=22;$i++){
        //     $user=User::find($i);
        //     $user->assignRole('user');
        // }
    }
}
