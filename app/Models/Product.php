<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Cart;
use App\Models\Unit;
use App\Models\Stock;

class Product extends Model
{
    protected $fillable=['name','slug','quantity',
    'summary','description','cat_id','child_cat_id','cost_price','on_price','off_price','brand_id','discount','status','photo','size','stock','is_featured','condition'];
    public static function store($request, $user_id){
        $profile=new Profile();
        $profile->user_id=$user_id;
        $profile->name=$request->name;
        $profile->phone=$request->phone;
        $profile->address=$request->address;
        $profile->urban=$request->urban;
        $profile->region=$request->region;
        $profile->province=$request->province;
        $profile->district=$request->district;
        $profile->ward=$request->ward;
        $profile->default='1';
        $profile->save();
        return true;
    }
    public static function updateQuantity($request){
        foreach($request->array as $item){
            $quantity=(int)$item['quantity'];
            $product_id=$item['id'];
            $product=Product::findOrFail($product_id);
            $product=Product::where('id',$product_id)->first();
            $product->quantity+=$quantity;
            $product->save();
        }
    }
    public function unit(){
        return $this->belongsTo(Unit::class);

    }
    // public function stock(){
    //     return $this->belongsTo(Stock::class);

    // }
    public function scopeStatus($query)
    {
        return $query->where('status', '1');
    }
    public function cat_info(){
        return $this->hasOne('App\Models\Category','id','cat_id');
    }
    public function sub_cat_info(){
        return $this->hasOne('App\Models\Category','id','child_cat_id');
    }
    public static function getAllProduct(){
        return Product::with(['cat_info','sub_cat_info'])->orderBy('id','desc')->get();
    }
    public function rel_prods(){
        return $this->hasMany('App\Models\Product','cat_id','cat_id')->where('status','active')->orderBy('id','DESC')->limit(8);
    }
    public function getReview(){
        return $this->hasMany('App\Models\ProductReview','product_id','id')->with('user_info')->where('status','active')->orderBy('id','DESC');
    }
    public static function getProductBySlug($slug){
        return Product::with(['cat_info','rel_prods','getReview'])->where('slug',$slug)->first();
    }
    public static function countActiveProduct(){
        $data=Product::where('status','active')->count();
        if($data){
            return $data;
        }
        return 0;
    }

    public function carts(){
        return $this->hasMany(Cart::class)->whereNotNull('order_id');
    }

    public function wishlists(){
        return $this->hasMany(Wishlist::class)->whereNotNull('cart_id');
    }

}
