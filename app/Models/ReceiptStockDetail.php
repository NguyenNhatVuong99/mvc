<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\Stock;
class ReceiptStockDetail extends Model
{
    protected $table="receipt_stock_details";
    protected $fillable=[
        'product_id',
        'cost_price',
        'quantity',
        'amount',
        'note'
    ];
    /**
     * Get the user that owns the DetailReceiptStock
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    
 
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    
    public  function receiptStock($cat_id)
    {
        return $this->belongsTo('App\Models\ReceiptStock')->where('cat_id',$cat_id);
    }
    public static function store($request){
        $receipt=ReceiptStock::where('code',$request->document_code)->first();
        foreach($request->array as $item){
            $quantity=(int)$item['quantity'];
            $cost_price=(int)$item['cost_price'];
            $amount=(int)$item['amount'];
            //LƯU CHI TIẾT CHỨNG TỪ KHO
            $detail=new ReceiptStockDetail();
            $detail->receipt_id=$receipt->id;
            $detail->product_id=$item['id'];
            $detail->cost_price=$cost_price;
            $detail->quantity=$quantity;
            $detail->amount=$amount;
            $detail->save();
        }
    }  

}
