<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $table="coupons";
    protected $fillable=['name','code','type','value','status','time_from','time_to'];

    // public static function findByCode($code){
    //     return self::where('code',$code)->first();
    // }
    // public function discount($total){
    //     if($this->type=="fixed"){
    //         return $this->value;
    //     }
    //     elseif($this->type=="percent"){
    //         return ($this->value /100)*$total;
    //     }
    //     else{
    //         return 0;
    //     }
    // }
}
