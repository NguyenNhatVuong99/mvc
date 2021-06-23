<?php

use Illuminate\Database\Seeder;
use App\Models\Category;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        App\Models\Category::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $data=[
            ['title'=> 'Áo đội tuyển','slug'=> 'ao-doi-tuyen','summary'=>NULL,'photo'=>NULL, 'is_parent'=>1, 'parent_id'=>NULL,'added_by'=> NULL, 'status'=>'1'],
            ['title'=> 'Áo câu lạc bộ','slug'=> 'ao-cau-lac-bo','summary'=>NULL,'photo'=>NULL, 'is_parent'=>1, 'parent_id'=>NULL,'added_by'=> NULL, 'status'=>'1'],
            ['title'=> 'Giày','slug'=> 'giay','summary'=>NULL,'photo'=>NULL, 'is_parent'=>1, 'parent_id'=>NULL,'added_by'=> NULL, 'status'=>'1'],
            ['title'=> 'Phụ kiện','slug'=> 'phu-kien','summary'=>NULL,'photo'=>NULL, 'is_parent'=>1, 'parent_id'=>NULL,'added_by'=> NULL, 'status'=>'1'],
            ['title'=> 'Premier League','slug'=> 'premier-league','summary'=>NULL,'photo'=>NULL, 'is_parent'=>0, 'parent_id'=>2,'added_by'=> NULL, 'status'=>'1'],
            ['title'=> 'Laliga','slug'=> 'laliga','summary'=>NULL,'photo'=>NULL, 'is_parent'=>0, 'parent_id'=>2,'added_by'=> NULL, 'status'=>'1'],
            ['title'=> 'Seria A','slug'=> 'seria-a','summary'=>NULL,'photo'=>NULL, 'is_parent'=>0, 'parent_id'=>2,'added_by'=> NULL, 'status'=>'1'],
            ['title'=> 'Bundesliga','slug'=> 'bundesliga','summary'=>NULL,'photo'=>NULL, 'is_parent'=>0, 'parent_id'=>2,'added_by'=> NULL, 'status'=>'1'],
            ['title'=> 'Giải đấu khác','slug'=> 'giai-dau-khac','summary'=>NULL,'photo'=>NULL, 'is_parent'=>0, 'parent_id'=>2,'added_by'=> NULL, 'status'=>'1'],
            
        ];
        Category::insert($data);
    }
}
