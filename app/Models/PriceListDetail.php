<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\PriceList;
use Illuminate\Database\Eloquent\SoftDeletes; 
class PriceListDetail extends Model
{
    use SoftDeletes;

    protected $table = "price_list_details";
    protected $fillable = ['price_list_id', 'product_id', 'cost_price','on_price', 'off_price', 'promotion_on_price', 'promotion_off_price'];
    
    public function priceList()
    {
        return $this->belongsTo(PriceList::class);

    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function scopePromotion($query)
    {
        return $query->where("isPromotion", 1);
    }
    public static function store($id){
        $priceListDefault=PriceList::default()->first();
        $detailDefault=PriceListDetail::where('price_list_id',$priceListDefault->id)->get();
        foreach($detailDefault as $value){
            $data=new PriceListDetail();
            $data->price_list_id=$id;
            $data->product_id=$value->product_id;
            $data->cost_price=$value->cost_price;
            $data->on_price=$value->on_price;
            $data->off_price=$value->off_price;
            $data->save();
        }

    }
    public static function calculation($format,$id,$default,$type_price){
        switch ($format->parent_price) {
            case "now_price":
                if($type_price=='on_price'){
                    $parent_price=$default->on_price;
                }
                else{
                    $parent_price=$default->off_price;

                }
                break;
            default:
                $parent_price=$default->cost_price;
            break;
        }
        switch ($format->type) {
            case 'person':
                $value=$parent_price * $format->value / 100;
                break;
            
            default:
                $value=$format->value;
                break;
        }
        switch ($format->calculation) {
            case 'add':
                return $result=$parent_price + $value;
                break;
            case 'sub':
                return $result=$parent_price - $value;
            default:
                return $result=$parent_price * $value;
                break;
        }
    }
    public static function updateDetail($request){
        if($request->type=="product"){
            foreach($request->arr as $item){
                $priceListDefault=PriceList::default()->first();
                $default=PriceListDetail::where('price_list_id',$priceListDefault->id)->where('product_id',$item)->first();
                $format=PriceListFormat::where('price_list_id',$request->id)->first();
                $promotion_off_price=PriceListDetail::calculation($format,$request->id,$default,'off_price');
                $promotion_on_price=PriceListDetail::calculation($format,$request->id,$default,'on_price');
                $data=PriceListDetail::where('price_list_id',$request->id)->where('product_id',$item)->first();
                $data->promotion_off_price=$promotion_off_price;                    
                $data->promotion_on_price=$promotion_on_price;
                $data->isPromotion=1;
                $data->save();                    
            }
        }
        else{
            if($request->child==''){
                $data=Product::where('cat_id',$request->category)->with('cat_info')->get();
                if($data->count()==0){
                    $category=Category::findOrFail($request->category);
                    return [404, 'Danh mục '.$category['title'].' rỗng'];
                }
            }
            else{
                // dd('child-cat');

                $data=Product::where('child_cat_id',$request->child)->get();
                if(!$data->count()){
                    $category=Category::findOrFail($request->child);
                    return [404, 'Danh mục '.$category['title'].' rỗng'];
                }
            }
            foreach($data as $item){
                $priceListDefault=PriceList::default()->first();
                $default=PriceListDetail::where('price_list_id',$priceListDefault->id)->where('product_id',$item->id)->first();
                $format=PriceListFormat::where('price_list_id',$request->id)->first();
                $promotion_off_price=PriceListDetail::calculation($format,$request->id,$default,'off_price');
                $promotion_on_price=PriceListDetail::calculation($format,$request->id,$default,'on_price');
                $data=PriceListDetail::where('price_list_id',$request->id)->where('product_id',$item->id)->first();
                $data->promotion_off_price=$promotion_off_price;                    
                $data->promotion_on_price=$promotion_on_price;
                $data->isPromotion=1;
                $data->save();                    
            }
        }
        
        
        return $request->id;
    }
    public static function deleteProduct($request){
        $data=PriceListDetail::findOrFail($request->id);
        $data->promotion_on_price=0;
        $data->promotion_off_price=0;
        $data->isPromotion=0;
        $data->save();
    }
    public static function updateProduct($detail){
        foreach($detail as $item){
            $priceListDefault=PriceList::default()->first();
            $default=PriceListDetail::where('price_list_id',$priceListDefault->id)->where('product_id',$item['product_id'])->first();
            $format=PriceListFormat::where('price_list_id',$item['price_list_id'])->first();
            $promotion_off_price=PriceListDetail::calculation($format,$item['price_list_id'],$default,'off_price');
            $promotion_on_price=PriceListDetail::calculation($format,$item['price_list_id'],$default,'on_price');
            $data=PriceListDetail::where('price_list_id',$item['price_list_id'])->where('product_id',$item['product_id'])->first();
            $data->promotion_off_price=$promotion_off_price;                    
            $data->promotion_on_price=$promotion_on_price;
            $data->isPromotion=1;
            $data->save();                    
        }

    }
    public static function destroy($id){
        PriceListDetail::where('price_list_id',$id)->delete();
    }
    
    public static function updatePrice($request){
        // dd($request->all());
        $data=PriceListDetail::findOrFail($request->id);
        switch ($request->type) {
            case 'cost_price':
                $data->cost_price=$request->value;
                break;
            case 'on_price':
                $data->on_price=$request->value;
                break;
            case 'off_price':
                $data->off_price=$request->value;
                break;
            case 'promotion_on_price':
                $data->promotion_on_price=$request->value;
                break;
            default:
                # code...
                $data->promotion_off_price=$request->value;
                break;
        }
        $data->save();
        
        // PriceListDetail::where('price_list_id',$id)->delete();
    }
    
}
