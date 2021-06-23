<?php

use Illuminate\Database\Seeder;
use App\User;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // factory(App\User::class, 100)->create();
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        App\User::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
                $data=array(
                    array(
                        'name'=>'Admin',
                        'email'=>'nhatvuong0699@gmail.com',
                        'phone'=>vnfaker()->mobilephone($numbers = 10),
                        'code'=>'AD0001',
                        'password'=>Hash::make('nhatvuong99'),
                    )
                );
                DB::table('users')->insert($data);
                $data=array(
                    array(
                        'name'=>'Nguyễn Trường',
                        'email'=>'quanly1@gmail.com',
                        'phone'=>vnfaker()->mobilephone($numbers = 10),
                        'code'=>'QL0002',
                        'password'=>Hash::make('nhatvuong99'),
                        
                    ),
                    array(
                        'name'=>'Nguyễn Kỳ',
                        'email'=>'quanly2@gmail.com',
                        'phone'=>vnfaker()->mobilephone($numbers = 10),
                        'code'=>'QL0003',
                        'password'=>Hash::make('nhatvuong99'),
                        

                    ),
                    array(
                        'name'=>'Nguyễn Kháng',
                        'email'=>'quanly3@gmail.com',
                        'phone'=>vnfaker()->mobilephone($numbers = 10),
                        'code'=>'QL0004',
                        'password'=>Hash::make('nhatvuong99'),
                        

                    )
                );
                DB::table('users')->insert($data);
                $data=array(
                    array(
                        'name'=>'Nguyễn Chiến',
                        'email'=>'thungan1@gmail.com',
                        'phone'=>vnfaker()->mobilephone($numbers = 10),
                        'code'=>'TN0005',
                        'password'=>Hash::make('nhatvuong99'),
                        'isPersonel'=>1,
                        

                    ),
                    array(
                        'name'=>'Nguyễn Nhất',
                        'email'=>'thungan2@gmail.com',
                        'phone'=>vnfaker()->mobilephone($numbers = 10),
                        'code'=>'TN0006',
                        'password'=>Hash::make('nhatvuong99'),
                        'isPersonel'=>1,

                        

                    ),
                    array(
                        'name'=>'Nguyễn Định',
                        'email'=>'thungan3@gmail.com',
                        'phone'=>vnfaker()->mobilephone($numbers = 10),
                        'code'=>'TN0007',
                        'password'=>Hash::make('nhatvuong99'),
                        'isPersonel'=>1,


                    ),
                    array(
                        'name'=>'Nguyễn Thắng',
                        'email'=>'thungan4@gmail.com',
                        'phone'=>vnfaker()->mobilephone($numbers = 10),
                        'code'=>'TN0008',
                        'password'=>Hash::make('nhatvuong99'),
                        'isPersonel'=>1,

                    ),
                    array(
                        'name'=>'Nguyễn Lợi',
                        'email'=>'thungan5@gmail.com',
                        'phone'=>vnfaker()->mobilephone($numbers = 10),
                        'code'=>'TN0009',
                        'password'=>Hash::make('nhatvuong99'),
                        'isPersonel'=>1,


                    ),
                    array(
                        'name'=>'Nguyễn Cộng',
                        'email'=>'thungan6@gmail.com',
                        'phone'=>vnfaker()->mobilephone($numbers = 10),
                        'code'=>'TN0010',
                        'password'=>Hash::make('nhatvuong99'),
                        'isPersonel'=>1,


                    ),
                    array(
                        'name'=>'Nguyễn Hòa',
                        'email'=>'thungan7@gmail.com',
                        'phone'=>vnfaker()->mobilephone($numbers = 10),
                        'code'=>'TN0011',
                        'password'=>Hash::make('nhatvuong99'),
                        'isPersonel'=>1,


                    ),
                    array(
                        'name'=>'Nguyễn Xã',
                        'email'=>'thungan8@gmail.com',
                        'phone'=>vnfaker()->mobilephone($numbers = 10),
                        'code'=>'TN0012',
                        'password'=>Hash::make('nhatvuong99'),
                        'isPersonel'=>1,


                    ),
                    array(
                        'name'=>'Nguyễn Hội',
                        'email'=>'thungan9@gmail.com',
                        'phone'=>vnfaker()->mobilephone($numbers = 10),
                        'code'=>'TN0013',
                        'password'=>Hash::make('nhatvuong99'),
                        'isPersonel'=>1,


                    )
                );
                                    DB::table('users')->insert($data);

                for($i=14; $i<=80; $i++){
                    if($i<=31){
                        $str='BH';
                        $isPersonel=1;
                    }
                    else if($i>31 && $i <=46 ){
                        $str='GX';
                        $isPersonel=1;

                    }
                    else if($i>46 && $i <=61 ){
                        $str='GH';
                        $isPersonel=0;

                    }
                    else{
                        $str='KH';
                        $isPersonel=1;

                    }
                    $data=array(
                        'name'=>vnfaker()->fullname($word = 3),
                        'email'=>vnfaker()->email(),
                        'phone'=>vnfaker()->mobilephone($numbers = 10),
                        'code'=>$str.'00'.$i,
                        'password'=>Hash::make('nhatvuong99'),
                        
                        'isPersonel'=>$isPersonel,


                    );
                    DB::table('users')->insert($data);
                }
               

                $data=array(
                    'name'=>'Khách vãng lai',
                    'email'=>vnfaker()->email(),
                    'phone'=>vnfaker()->mobilephone($numbers = 10),
                    'code'=>'KVL0000',
                    'password'=>Hash::make('nhatvuong99'),
                );
                DB::table('users')->insert($data);


                // factory(User::class, 16)->create();
    }
}
