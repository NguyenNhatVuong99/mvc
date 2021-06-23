<?php

use Illuminate\Database\Seeder;
use App\Models\Profile;
use Buihuycuong\Vnfaker\VNFaker;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Profile::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $faker = Faker\Factory::create();
        
    for($i = 1; $i <=61; $i++) {
            Profile::create([
                'user_id' => $i,
                'name'=>vnfaker()->fullname($word = 3),
                'phone'=>vnfaker()->fixedLineNumber($numbers = 10),
                'province'=>'201,Quảng Nam',
                'address'=>'137 Đỗ Đăng Tuyển',
                'district'=>'1482,Đại Lộc',
                'ward'=>'11010,Ái Nghĩa',
                'default'=>0,
                'region'=>2,
                'urban'=>0
                ]);    
    }
    for($i = 62; $i <=80; $i++) {
            Profile::create([
                'user_id' => $i,
                'name'=>vnfaker()->fullname($word = 3),
                'phone'=>vnfaker()->fixedLineNumber($numbers = 10),
                'province'=>'201,Quảng Nam',
                'address'=>'137 Đỗ Đăng Tuyển',
                'district'=>'1482,Đại Lộc',
                'ward'=>'11010,Ái Nghĩa',
                'default'=>0,
                'region'=>2,
                'urban'=>0
                ]);    
            Profile::create([
                'user_id' => $i,
                'name'=>vnfaker()->fullname($word = 3),
                'phone'=>vnfaker()->fixedLineNumber($numbers = 10),
                'province'=>'201,Quảng Nam',
                'address'=>'137 Đỗ Đăng Tuyển',
                'district'=>'1482,Đại Lộc',
                'ward'=>'11010,Ái Nghĩa',
                'default'=>0,
                'region'=>2,
                'urban'=>0
                ]);    
    }


    }
}
