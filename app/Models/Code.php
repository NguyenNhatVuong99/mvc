<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
    public static function create($id,$cat_id){
        $cat=ReceiptCategory::find($cat_id);
        $lengthId=strlen($id);
        if($lengthId>6){
            $count=9;
        }
        else{
            $count=6;
        }
        $str=$cat->code;

        $length=$count-$lengthId;
        for($i=0; $i<$length; $i++){
            $str.='0';
        }
        return $str.$id;


    }
}
