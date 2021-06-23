<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Supplier;
use App\Models\Code;
use App\User;
use App\Models\ReceiptStockDetail;
use DB;
class ReceiptStock extends Model

{
    protected $table="receipt_stocks";
    protected $fillable=['id','code','document_code','document_date','total','debt','cat_id','child_cat_id','partner_code','partner_id','note','status'];
    public function supplier(){
        return $this->belongsTo('App\Models\Supplier');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function category()
    {
        return $this->belongsTo('App\Models\ReceiptCategory', 'cat_id');
    }
    public function child_category()
    {
        return $this->belongsTo('App\Models\ReceiptCategory', 'child_cat_id');
    }
    public function details(){
        return $this->hasMany('App\Models\ReceiptStockDetail');
    }
    public static function showDetail($id){
        return ReceiptStockDetail::with('product')->where('receipt_id',$id)->get();
    }
    // public  function detail()
    // {
    //     return DB::table('receipt_stock_details as detail')
    //     ->join('receipt_stocks','receipt_stocks.id','detail.receipt_id')
    //     ->where('re')
    //     ->get();
    //     // return DB::table('detail_receipt_stocks')::SELECT detail_receipt_stocks.product_id, SUM(detail_receipt_stocks.quantity) ,SUM(detail_receipt_stocks.amount)FROM detail_receipt_stocks JOIN receipt_stocks ON receipt_stocks.id=detail_receipt_stocks.receipt_id WHERE receipt_stocks.cat_id=3 GROUP BY detail_receipt_stocks.product_id' ;
    //     // // return $this->hasMany('App\Models\ReceiptStockDetail', 'receipt_id')
    //     // //             ->selectRaw('detail_receipt_stocks.product_id,SUM(detail_receipt_stocks.quantity) as quantity,
    //     //             SUM(detail_receipt_stocks.quantity*detail_receipt_stocks.cost_price) as amount')
    //     //             ->groupBy('detail_receipt_stocks.product_id');
    // }
    public static function updateDebt($request){
        $receiptStock=ReceiptStock::where('code',$request->document_code)->first();
        $receiptStock->debt-=$request->payment;
        $receiptStock->payment+=$request->payment;
        $receiptStock->save();
        if($receiptStock->debt<=0){
            $receiptStock->isPayment='Hoàn thành';
            $receiptStock->debt=0;
            $receiptStock->save();
        }
    }
    public static function productImportIndex(){
        $cat=ReceiptCategory::where('code','PN')->first();
        $receipt=ReceiptStock::where('cat_id',$cat->id)->get();
        $data=[];
        foreach ($receipt as $key => $value) {
            $partner=Partner::index($value);
            $user=User::find($value->user_id)->select('name as user_name','code as user_code')->first();
            $obj=array_merge($value->toArray(), $partner->toArray(),$user->toArray());
            array_push($data,$obj);
        }
        return $data;
    }
    public static function updateIsPayment($request){
        if($request->debt <= $request->total){
            $receipt=ReceiptStock::where('code',$request->document_code)->first();
            $receipt->isPayment=1;
            $receipt->save();
        }
        return true;
    }
    public function scopeStatus($query)
    {
        return $query->where('status', 'active');
    }
    public function scopeCategory($query,$cat){
        return $query->where('cat_id',$cat);
    }
    // public function partner(){
    //     return $this->belongsTo('App\Models\Partner','partner_id');
    // }
    
    public static function datatable($request){
        $start = date('Y-m-d', strtotime($request->start));
        $end = date('Y-m-d', strtotime($request->end));
        $cat=ReceiptCategory::where('code',$request->cat)->firstOrFail();
        if ($request->cat=='PN')
        {
            // $data=ReceiptStock::with(['partner'])->get();
            $data=ReceiptStock::with(['partner'])
                        ->whereBetween(DB::raw('DATE(`date`)'), [$start, $end])
                        ->where('cat_id',$cat->id)
                        ->get();
        }
        else{
            $data=ReceiptStock::with(['user'])
                        ->whereBetween(DB::raw('DATE(`date`)'), [$start, $end])
                        ->where('cat_id',$cat->id)
                        ->get();
        }
        return $data;
    }
    public static function store($request)
    {
        if($request->debt>0){
            $isPayment="Nợ";
        }
        else{
            $isPayment="Hoàn thành";
        }
        $user_id=Auth::user()->id;
        $arr=$request->array;
        $receipt_stock=new ReceiptStock();
        $receipt_stock->cat_id=$request->cat_receipt_stock;
        $receipt_stock->child_cat_id=$request->child_cat_receipt_stock;
        $receipt_stock->user_id=$user_id;
        $receipt_stock->partner_code=$request->partner_code;
        $receipt_stock->partner_id=$request->partner_id;
        $receipt_stock->quantity=$request->total_quantity;
        $receipt_stock->total=$request->total_price;
        $receipt_stock->payment=$request->payment;
        $receipt_stock->debt=$request->debt;
        $receipt_stock->note=$request->note;
        $receipt_stock->date_import=$request->date_import;
        $receipt_stock->status=$request->status;
        $receipt_stock->date_delivery=$request->date_delivery;
        $receipt_stock->save();
        $id=$receipt_stock->id;
        $code = Code::create($id,$request->cat_receipt_stock);
        $receipt_stock->code=$code;
        $receipt_stock->isPayment=$isPayment;
        $receipt_stock->save();
        return array($code,$request->date_import);
    }
    public function complete($request){
        
    }
    // public static function store($request, $child_cat,$cat,$partner_id,$partner_code)
    // {
    //     $user_id=Auth::user()->id;
    //     $arr=$request->array;
    //     $receipt_stock=new ReceiptStock();
    //     $receipt_stock->cat_id=$cat->id;
    //     $receipt_stock->child_cat_id=$child_cat->id;
    //     $receipt_stock->partner_id=$partner_id;
    //     $receipt_stock->branch_id=$request->branch_id;
    //     $receipt_stock->user_id=$user_id;
    //     $receipt_stock->partner_code=$partner_code;
    //     $receipt_stock->quantity=$request->total_quantity;
    //     $receipt_stock->total=$request->total_price;
    //     $receipt_stock->payment=$request->payment;
    //     $receipt_stock->debt=$request->debt;
    //     $receipt_stock->note=$request->note;
    //     $receipt_stock->date_import=$request->date_import;
    //     $receipt_stock->status=$request->status;
    //     $receipt_stock->date_delivery=$request->date_delivery;
    //     $receipt_stock->save();
    //     $id=$receipt_stock->id;
    //     $code = Code::create($id,$cat);
    //     $receipt_stock->code=$code;
    //     $receipt_stock->isPayment=$isPayment;
    //     $receipt_stock->save();
    //     ReceiptStockDetail::create($request->array,$id,$request);
        
    //     if($request->debt>0){
    //         $isPayment="Nợ";
    //         $debt_cat='CNPC';
    //         Debt::create($partner_id,$partner_code,$debt_cat,$code,$request);
            
    //     }
    //     else{
    //         $isPayment="Hoàn thành";
    //     }
        
    //     if($request->payment>0){
    //         $status='Hoàn thành';
    //         $cat=ReceiptCategory::where('code','PC')->first();
    //         $child_cat=ReceiptCategory::where('name','Chi nhập hàng')->first();
    //         Receipt::create($code,$request,$partner_id,$partner_code,$status,$cat,$child_cat);
    //     }
    //     Supplier::updateSupplier($request);
    // }
    // public static function storeReceiptStock($request,$cat_id,$partner_id,$status){
    //     $date=date('Y-m-d', strtotime($request->date));
    //     $count=6;
    //     $arr=$request->array;

    //     $receipt_stock=new ReceiptStock();
    //     $receipt_stock->cat_id=$cat_id;
    //     $receipt_stock->child_cat_id=$request->child_cat_id;
    //     $receipt_stock->partner_id=$partner_id;
    //     $receipt_stock->partner_code=$request->partner_code;
    //     $receipt_stock->quantity=$request->quantity;
    //     $receipt_stock->total=$request->total;
    //     $receipt_stock->payment=$request->payment;
    //     $receipt_stock->debt=$request->debt;
    //     $receipt_stock->note=$request->note;
    //     $receipt_stock->status=$status;
    //     $receipt_stock->date=$date;
    //     $receipt_stock->save();
    //     $id=$receipt_stock->id;
        
    //     $lengthId=strlen($id);
    //     if($lengthId>6){
    //         $count=9;
    //     }
    //     $str=$request->category;
    //     $length=$count-$lengthId;
    //     for($i=0; $i<$length; $i++){
    //         $str.='0';
    //     }
    //     $code=$str.$id;
    //     $receipt_stock->code=$code;
    //     $receipt_stock->save();

    //     foreach($arr as $item){
    //         $quantity=(int)$item['quantity'];
    //         $cost_price=(int)$item['cost_price'];
    //         $price=(int)$item['price'];
    //         $amount=(int)$item['amount'];

    //         //LƯU CHI TIẾT CHỨNG TỪ KHO
    //         $detail=new ReceiptStockDetail();
    //         $detail->receipt_id=$id;
    //         $detail->product_id=$item['id'];
    //         $detail->cost_price=$cost_price;
    //         $detail->price=$price;
    //         $detail->quantity=$quantity;
    //         $detail->amount=$amount;
    //         $detail->save();
    //         //CẬP NHẬT SẢN PHẨM
    //         $product=Product::findOrFail($item['id']);
    //         $product->cost_price=$cost_price;
    //         $product->price=$price;
    //         $product->quantity+=$quantity;
    //         $product->save();
    //         //CẬP NHẬT KHO
    //     }
    //     return  $code;
        
        
    // }
    // public static function store(Request $request){
    //     $count=6;
    //     $date=date('Y-m-d', strtotime($request->date));
    //     $cat=ReceiptCategory::where('code',$request->category)->firstOrFail();
    //     $cat_id=$cat->id;
    //     $partner=Partner::where('slug',$request->partner_slug)->first();
    //     if($request->debt == 0){
    //         $status="Hoàn thành";
    //     }
    //     else{
    //         $status="Nợ";
    //     }
    //     if($request->category=='PN'){
    //         $supplier=Supplier::where('code',$request->partner_code)->firstOrFail();
    //         $supplier->total+=$request->total;
    //         $supplier->debt+=$request->debt;
    //         $supplier->save();
            
    //     }
    //     $document_code=ReceiptStock::storeReceiptStock($request,$cat_id,$partner->id,$status);
    //     $note=ReceiptCategory::select('name')->find($request->child_cat_id);
    //     if($request->payment > 0){
           
    //         $receipt=new Receipt();
    //         $receipt->cat_id=$cat_id;
    //         $receipt->document=$document_code;
    //         $receipt->document_date=$date;
    //         $receipt->child_cat_id=$request->child_cat_id;
    //         $receipt->partner_id=$partner->id;
    //         $receipt->partner_code=$request->partner_code;
    //         $receipt->total=$request->payment;
    //         $receipt->note=$note. ' '.$document_code;
    //         $receipt->status='Hoàn thành';
    //         $receipt->save();
    //         $id=$receipt->id;
    //         $lengthId=strlen($id);
    //         $length=$count-$lengthId;
    //         for($i=0; $i<$length; $i++){
    //             $request->receipt.='0';
    //         }
    //         $code_receipt=$request->receipt.$id;
    //         $receipt->code=$code_receipt;
    //         $receipt->save();
    //     }
    //     return true;

        
    // }
    // public static function stores(Request $request){
    //     $date=date('Y-m-d', strtotime($request->date));
    //     $count=6;
    //     $arr=$request->array;
    //     if($request->debt == 0){
    //         $status="Hoàn thành";
    //     }
    //     else{
    //         $status="Nợ";
    //     }
        
    //     //LƯU CHỨNG TỪ KHO
    //     $receipt_stock=new ReceiptStock();
    //     $receipt_stock->cat_id=3;
    //     $receipt_stock->child_cat_id=16;
    //     $receipt_stock->partner_id=$partner->id;
    //     $receipt_stock->partner_code=$request->partner_code;
    //     $receipt_stock->quantity=$request->quantity;
    //     $receipt_stock->total=$request->total;
    //     $receipt_stock->payment=$request->payment;
    //     $receipt_stock->debt=$request->debt;
    //     $receipt_stock->note=$request->note;
    //     $receipt_stock->status=$status;
    //     $receipt_stock->date=$date;
    //     $receipt_stock->save();
    //     $id=$receipt_stock->id;
        
    //     $lengthId=strlen($id);
    //     if($lengthId>6){
    //         $count=9;
    //     }
    //     $length=$count-$lengthId;
    //     for($i=0; $i<$length; $i++){
    //         $request->category.='0';
    //     }
    //     $code=$request->category.$id;
    //     $receipt_stock->code=$code;
    //     $receipt_stock->status=$status;
    //     $receipt_stock->save();
        
        
    //     // // CẬP NHẬT NHÀ CUNG CẤP
    //     // $suppiler=Supplier::firstOrFail($request->suppiler);
    //     $supplier=Supplier::where('code',$request->partner_code)->firstOrFail();
    //     $supplier->total+=$request->total;
    //     $supplier->debt+=$request->debt;
    //     $supplier->save();
    //     foreach($arr as $item){
    //         $quantity=(int)$item['quantity'];
    //         $cost_price=(int)$item['cost_price'];
    //         $price=(int)$item['price'];
    //         $amount=(int)$item['amount'];
    //         //LƯU CHI TIẾT CHỨNG TỪ KHO
    //         $detail=new ReceiptStockDetail();
    //         $detail->receipt_id=$id;
    //         $detail->product_id=$item['id'];
    //         $detail->cost_price=$cost_price;
    //         $detail->price=$price;
    //         $detail->quantity=$quantity;
    //         $detail->amount=$amount;
    //         $detail->save();
    //         //CẬP NHẬT SẢN PHẨM
    //         $product=Product::findOrFail($item['id']);
    //         $product->cost_price=$cost_price;
    //         $product->price=$price;
    //         $product->quantity+=$quantity;
    //         $product->save();
    //         //CẬP NHẬT KHO
    //         $stock=Stock::findOrFail($item['id']);
    //         $stock->capital_inventory+=$cost_price*$quantity;
    //         $stock->value_inventory+=$price*$quantity;
    //         $stock->quantity+=$quantity;
    //         $stock->save();
    //     }
    //     if($request->payment > 0){
    //         $cat=ReceiptCategory::where('code','PN')->firstOrFail();
    //         $child_cat=ReceiptCategory::where('slug',$request->slug)->firstOrFail();
    //         $receipt=new Receipt();
    //         $receipt->cat_id=$cat->id;
    //         $receipt->document=$code;
    //         $receipt->document_date=$date;
    //         $receipt->child_cat_id=$child_cat->id;
    //         $receipt->partner_id=$partner->id;
    //         $receipt->partner_code=$request->partner_code;
    //         $receipt->total=$request->payment;
    //         $receipt->note='Thanh toán cho đơn mua hàng '.$code;
    //         $receipt->status='Hoàn thành';
    //         $receipt->save();
    //         $id=$receipt->id;
    //         $lengthId=strlen($id);
    //         $length=$count-$lengthId;
    //         for($i=0; $i<$length; $i++){
    //             $prefix.='0';
    //         }
    //         $code_receipt=$prefix.$id;
    //         $receipt->code=$code_receipt;
    //         $receipt->save();
    //     }
        
        
    //     // NỢ
    //     // $href='admin/'
    //     if($request->debt>0){
    //         $debt=new Debt();
    //         $debt->supplier_code=$request->supplier;
    //         $debt->debit=$request->debt;
    //         $debt->document=$code;
    //         $debt->date=$date;
    //         $debt->category='CNPC';
    //         $debt->note='Nợ tiền hàng '.$supplier->name;
    //         $debt->save();
    //     }
    //     return true;
    // }
    // public static function outOfStock($id){
    //     $out=ReceiptStock::findOrFail($id);
    //     $out->status='Nợ';
    //     $out->date=Carbon::now()->toDateTimeString();
    //     $out->save();
    //     return true;
    // }
    // public static function nhapXuatDauKy($cat,$start){
    //     return DB::table('detail_receipt_stocks as detail')
    //             ->join('receipt_stocks','receipt_stocks.id','detail.receipt_id')
    //             ->join('products','detail.product_id','products.id')
    //             ->join('units','units.id','products.unit_id')
    //             ->selectRaw('products.code as code,products.name as name,units.name as unit,
    //                         SUM(detail.quantity) as quantity,
    //                         SUM(detail.amount) as amount')
    //             ->where([['receipt_stocks.cat_id',$cat],['receipt_stocks.date', '<', $start]])
    //             ->groupBy('detail.product_id')
    //             ->get();
    //             // ->toArray();
    // }
    // public static function convertInt($str){
    //     return int($str);
    // }
    // public static function dauKy($arr_nhap, $arr_xuat){
    //     $dauKy = array();   
    //     foreach ($arr_nhap as $key_nhap => $nhap)
    //     {
    //         foreach ($arr_xuat as $key_xuat => $xuat)
    //         {
    //             $nhap->quantity=intval($nhap->quantity);
    //             $xuat->quantity=intval($xuat->quantity);
    //             $nhap->amount=intval($nhap->amount);
    //             $xuat->amount=intval($xuat->amount);
    //             if ($nhap->code === $xuat->code)
    //             {
    //                 echo ($nhap->quantity."<br />");
    //                 echo ($xuat->quantity."<br />");

    //                 $object = (object)[
    //                     'code' => $xuat->code,
    //                     'unit' => $xuat->unit,
    //                     'name'=>$xuat->name,
    //                     'quantity'=>$nhap->quantity-$xuat->quantity,
    //                     'amount' =>$nhap->amount-$xuat->amount,
    //                 ];
    //                 array_push($dauKy, $object);
    //                 unset($arr_nhap[$key_nhap]);
    //                 unset($arr_xuat[$key_xuat]);
    //             }
    //         }
    //     }
    //     foreach ($arr_nhap as $key_nhap => $nhap)
    //     {
    //         $nhap->quantity=intval($nhap->quantity);
    //         $nhap->amount=intval($nhap->amount);
    //         $object = (object)[
    //             'code' => $nhap->code,
    //             'unit' => $nhap->unit,
    //             'name'=>$nhap->name,
    //             'quantity'=>$nhap->quantity,
    //             'amount'=>$nhap->amount,
    //         ];
    //         array_push($dauKy, $object);
    //     }
    //     return $dauKy;
    // }
    
    // public static function balance($request){
    //     $start = date('Y-m-d', strtotime($request->start));
    //     $end = date('Y-m-d', strtotime($request->end));
    //     $cat_PN=ReceiptCategory::where('code','PN')->firstOrFail();
    //     $cat_PX=ReceiptCategory::where('code','PX')->firstOrFail();
    //     $arr_nhap=ReceiptStock::nhapXuatDauKy($cat_PN->id,$start);   
    //     $arr_xuat=ReceiptStock::nhapXuatDauKy($cat_PX->id,$start);
    //     // dd($arr_nhap);
    //     dd($arr_xuat);
    //     $dauKy=ReceiptStock::dauKy($arr_nhap,$arr_xuat);   
    //     dd($dauKy);    
                
    //         $data['phatsinh'] = Debt::selectRaw('SUM(debit) as debit,
    //                 SUM(credit) as credit')->where('category', $request->cat)
    //             ->whereBetween('date', [$start, $end])
    //             ->where('user_id', $request->user_id)
    //             ->where('status',1)
    //             ->groupByRaw('user_id')
    //             ->first();
    //             $data['detail_phatsinh']=Debt::whereBetween('date', [$start, $end])
    //                         ->where('user_id', $request->user_id)
    //                         ->where('status',1)
    //                         ->get();
        
    //         if ($data['phatsinh'] == null)
    //         {
    //             $data['phatsinh']['debit'] = 0;
    //             $data['phatsinh']['credit'] = 0;
    //         }
    //         if ($data['dauky'] == null)
    //         {
    //             $data['dauky']['debit'] = 0;
    //             $data['dauky']['credit'] = 0;
    //         }
    //         $data['cuoiky'] = array();
    //         $data['cuoiky'] = (object)[
    //                         'debit' => $data['dauky']['debit'] + $data['phatsinh']['debit'] - $data['phatsinh']['credit'], 
    //                         'credit' => $data['dauky']['credit'] + $data['phatsinh']['credit'] - $data['phatsinh']['debit']
    //                     ];
    //         return $data;

    // } 
}
