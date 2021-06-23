<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;
class Cashflow extends Model
{
    protected $table='cashflows';
    protected $fillable=['code','date','cat_id','user_id','supplier_id','child_cat_id','user_id','total','note'];
    public static function getPC(){
        return Cashflow::where('cat_id','2')->get();
    }
    public static function getPT(){
        return Cashflow::where('cat_id','1')->get();
    }
    public function user(){
        return $this->belongsTo('App\User','user_id');
    }
    public function supplier(){
        return $this->belongsTo('App\Models\Supplier','supplier_id');
    }
    public function child_cat(){
        return $this->belongsTo('App\Models\CategoryReceipt','child_cat_id');
    }
    public static function create($document_code,$request,$partner_id,$partner_code,$status,$cat,$child_cat){
        $child_cat=ReceiptCategory::find($child_cat->id);
        $note="Thanh toán cho chứng từ ".$document_code;
        $user_id=Auth::user()->id;
        $data=new Cashflow();
        $data->document_code=$document_code;
        $data->document_date=$request->date_import;
        $data->date=$request->date_import;
        $data->user_id=$user_id;
        $data->cat_id=$cat->id;
        $data->child_cat_id=$child_cat->id;
        $data->partner_id=$partner_id;
        $data->partner_code=$partner_code;
        $data->total=$request->payment;
        $data->note=$note;
        $data->account_id=$request->account_id;
        $data->status=$status;
        $data->save();
        $id=$data->id;
        $code = Code::create($id,$cat);
        $data->code=$code;
        $data->save();
    }
    public static function storeCashflow($request){
        if($request->receipt_note){
            $note=$request->receipt_note;
        }
        else{
            $note="Thanh toán cho chứng từ ".$request->document_code;
        }
        $user_id=Auth::user()->id;
        $data=new Cashflow();
        $data->document_code=$request->document_code;
        $data->document_date=$request->document_date;
        $data->date=$request->date;
        $data->user_id=$user_id;
        $data->cat_id=$request->cat_receipt;
        $data->child_cat_id=$request->child_cat_receipt;
        $data->partner_id=$request->partner_id;
        $data->partner_code=$request->partner_code;
        $data->total=$request->payment;
        $data->note=$note;
        $data->account_id=$request->account_id;
        $data->save();
        $id=$data->id;
        $code = Code::create($id,$request->cat_receipt);
        $data->code=$code;
        $data->save();
        return true;
    }
    public static function PT(Request $request){
        $start=date('Y-m-d', strtotime($request->start));
        $end=date('Y-m-d', strtotime($request->end));
        $cat=CategoryReceipt::where('code',$request->cat)->firstOrFail();
        $receipts=Cashflow::with(['user','child_cat'])
                                ->whereBetween(DB::raw('DATE(`created_at`)'), [$start, $end])
                                ->where('cat_id',$cat->id)->get();
                                // dd($receipts);
                $data=Datatables::of($receipts)
                                ->addColumn('child_cat', function (Receipt $receipt) {
                                    return $receipt->child_cat->name;
                                })
                                ->addColumn('user', function (Receipt $receipt) {
                                        return ($receipt->user!=null) ? $receipt->user->name : '';
                                })
                                ->addColumn('action', function (Receipt $receipt) {
                                    return '<a href="'. route('admin.receipt.show', $receipt->id) .'" class="btn btn-xs btn-warning"><i class="fa fa-eye"></i> View</a> <a href="javascript:void(0)" data-id="' . $receipt->id . '" class="btn btn-xs btn-danger btn-delete"><i class="fa fa-times"></i> Delete</a>';
                                })
                                ->rawColumns([ 'action','user','child_cat'])
                                ->make(true);
                return $data;                
    }
    public static function PC(Request $request){
        $start=date('Y-m-d', strtotime($request->start));
        $end=date('Y-m-d', strtotime($request->end));
        $cat=CategoryReceipt::where('code',$request->cat)->firstOrFail();
        $receipts=Cashflow::with(['user','child_cat'])
                                ->whereBetween(DB::raw('DATE(`created_at`)'), [$start, $end])
                                ->where('cat_id',$cat->id)->get();
                                // dd($receipts);
                $data=Datatables::of($receipts)
                                ->addColumn('child_cat', function (Receipt $receipt) {
                                    return $receipt->child_cat->name;
                                })
                                ->addColumn('supplier', function (Receipt $receipt) {
                                        return ($receipt->supplier!=null) ? $receipt->supplier->name : '';
                                })
                                ->addColumn('action', function (Receipt $receipt) {
                                    return '<a href="'. route('admin.receipt.show', $receipt->id) .'" class="btn btn-xs btn-warning"><i class="fa fa-eye"></i> View</a> <a href="javascript:void(0)" data-id="' . $receipt->id . '" class="btn btn-xs btn-danger btn-delete"><i class="fa fa-times"></i> Delete</a>';
                                })
                                ->rawColumns([ 'action','supplier','child_cat'])
                                ->make(true);
                return $data;                
    }
    public static function index(Request $request){
            if($request->cat='PC'){
            }
            else{
                $receipts=Cashflow::with(['user','child_cat'])
                                ->whereBetween(DB::raw('DATE(`created_at`)'), [$start, $end])
                                ->where('cat_id',$cat->id);
                $data=Datatables::of($receipts)
                                // ->addColumn('child_cat', function (Receipt $receipt) {
                                //     return $receipt->child_cat->name;
                                // })
                                // ->addColumn('user', function (Receipt $receipt) {
                                //         return $receipt->user->name;
                                // })
                                ->make(true);
                                // dd($data);
                return $data;  
            }
    }
  
    public static function  updateStatus($request){
        $data=Cashflow::findOrFail($request->id);
        $receipt->status='Hoàn thành';
        $receipt->save();
        Debt::updateStatus($receipt);
        return true;
    }
}
