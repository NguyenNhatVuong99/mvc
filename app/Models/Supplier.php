<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model 
{
    protected $table="suppliers";
    protected $fillable=['code','name','total','debt','address','phone','id','status'];
    public function scopeStatus($query){
        return $query->where("status", 1); 
    }
    public static function updateSupplier($request){
        
        $supplier=Supplier::where('code',$request->supplier_code)->first();
        $supplier->total+=$request->total_price;
        $supplier->debt+=$request->debt;
        $supplier->payment+=$request->payment;
        $supplier->save();
    }
    public static function updateDebt($request){
        $supplier=Supplier::where('code',$request->partner_code)->first();
        $supplier->debt-=$request->debt;
        $supplier->payment+=$request->payment;
        $supplier->save();
    }
    public static function store($request){
        $supplier=new Supplier();
        $supplier->name=$request->name;
        $supplier->phone=$request->phone;
        $supplier->address=$request->address;
        $supplier->total=0;
        $supplier->debt=0;
        $supplier->status=1;
        $supplier->code='';
        $supplier->save();
        $id=$supplier->id;
        $lengthId=strlen($id);
        $length=6-$lengthId;
        $prefix='NCC';
        for($i=0; $i<$length; $i++){
            $prefix.='0';
        }
        $code=$prefix.$id;
        $supplier->code=$code;
        $supplier->save();
    }
    
}
