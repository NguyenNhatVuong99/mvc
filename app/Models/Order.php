<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable=['order_code','profile_id','sub_price','coupon','fee_ship','total_price','quantity','giveFriend','payments','service_name','delivery_time','status_id'];
    public function status(){
        return $this->belongsTo('App\Models\StatusOrder');
    }
    public function detailCart(){
        return $this->hasMany('App\Models\DetailCart','order_id','id');
    }
    public static function getAllOrder($id){
        return Order::with('cart_info')->find($id);
    }
    public static function countActiveOrder(){
        $data=Order::count();
        if($data){
            return $data;
        }
        return 0;
    }
    public function cart(){
        return $this->hasMany(Cart::class);
    }

    public function shipping(){
        return $this->belongsTo(Shipping::class,'shipping_id');
    }
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
    public function profile()
    {
        return $this->belongsTo('App\Models\Profile', 'profile_id');
    }
    public function statusOrder()
    {
        return $this->belongsTo('App\Models\StatusOrder', 'status_id');
    }

}
