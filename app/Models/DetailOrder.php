<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailOrder extends Model
{
    protected $table="detail_orders";
    protected $fillable=[
        'order_id',
        'product_id',
        'quantity',
        'price',
        'amount'
    ];
    public static function getDetail($id){
        return DetailOrder::select('products.price as product_price','products.*','detail_orders.*')
        ->join('products', 'detail_orders.product_id', '=', 'products.id')
        ->where('order_id',$id)->get();
        
    }
}
