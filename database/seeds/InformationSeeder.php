<?php

use Illuminate\Database\Seeder;
use App\Models\Information;
class InformationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        App\Models\Information::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $data=[
            'logo'=>'photos/1/logo/logo.svg',
            'photo'=>'photos/1/logo/logo.svg',
            'description'=>'MVC Shop',
            'phone'=>'0896204185',
            'email'=>'nhatvuong0699@gmail.com',
            'address'=>'56 Chu Mạnh Trinh, Cẩm lệ, Đà Nẵng'
        ];
        Information::create($data);
    }
}
