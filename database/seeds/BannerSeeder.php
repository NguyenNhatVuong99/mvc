<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Buihuycuong\Vnfaker\VNFaker;
class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        App\Models\Banner::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $data=[
            ['title'=> vnfaker()->sentences(),
            'photo'=> '/photos/1/Banner/banner4.jpg',
            'description'=>vnfaker()->sentences()
            ],
            ['title'=> vnfaker()->sentences(),
            'photo'=> '/photos/1/Banner/banner2.jpg',
            'description'=>vnfaker()->sentences()
            ],
            ['title'=> vnfaker()->sentences(),
            'photo'=> '/photos/1/Banner/banner3.jpg',
            'description'=>vnfaker()->sentences()
            ],
            
        ];
        DB::table('banners')->insert($data);
    }
}
