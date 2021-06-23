<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class PriceListFormat extends Model
{
    use SoftDeletes;
    protected $table = "price_list_formats";
    protected $fillable = ['price_list_id', 'parent_price', 'calculation', 'value', 'type'];
    public function scopeDefault($query)
    {
        return $query->where("default", 1);
    }
    
    public function priceList()
    {
        return $this->belongsTo('App\Models\PriceList');
    }
    
    public static function store($id){
        $data=new PriceListFormat();
        $data->price_list_id=$id;
        $data->value=0;
        $data->save();
    }
    public static function updateFormat($request){
        $data=PriceListFormat::findOrFail($request->id);
        $data->value=$request->value;
        $data->type=$request->type;
        $data->parent_price=$request->parent_price;
        $data->calculation=$request->calculation;
        $data->save();
        return $data->price_list_id;

    }
    public static function destroy($id){
        PriceListFormat::where('price_list_id',$id)->delete();
    }
}
