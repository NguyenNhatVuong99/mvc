<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Branch;
use App\Models\Product;
class Stock extends Model
{
    protected $table="stocks";
    protected $fillable=['product_id','branch_id','quantity'];
    
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public static function updateStock($request){
        foreach($request->array as $item){
            $quantity=(int)$item['quantity'];
            $product_id=$item['id'];
            $product=Product::findOrFail($product_id);
            $min=$product->min;
            if($min<=$quantity){
                $isWarning=1;
            }
            else{
                $isWarning=0;
            }
            $stock=Stock::where('product_id',$product_id)->where('branch_id',$request->branch_id)->first();
            $stock->quantity+=$quantity;
            $stock->isWarning=$isWarning;
            $stock->save();
        }
    }
}
