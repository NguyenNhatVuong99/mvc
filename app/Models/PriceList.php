<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes; 
class PriceList extends Model
{
    use SoftDeletes;
    protected $table = "price_lists";
    protected $fillable = ['title', 'default','status'];
    public function scopeDefault($query)
    {
        return $query->where("default", 1);
    }
    public static function store($request){
        $end_date =date('Y-m-d h:i:s', strtotime($request->end_date));
        $start_date =date('Y-m-d h:i:s', strtotime($request->start_date));
        $data=new PriceList();
        $data->title=$request->title;
        $data->end_date=$end_date;
        $data->start_date=$start_date;
        $data->save();
        return $data->id;
    }
    public static function destroy($id){
        PriceList::findOrFail($id)->delete();
    }
    public static function getCostPrice($id){
        $default=PriceList::default()->first();
        $data=PriceListDetail::where('price_list_id',$default->id)->where('product_id',$id)->first();
        return $data;
    }
    public static function getPriceDefault($id){
        $default=PriceList::default()->first();
        $data=PriceListDetail::where('price_list_id',$default->id)->where('product_id',$id)->first();
        return $data;
    }
    public static function updatePriceList($request){
        $end_date =date('Y-m-d h:i:s', strtotime($request->end_date));
        $start_date =date('Y-m-d h:i:s', strtotime($request->start_date));
        if($request->status==0){
            $default=PriceList::where('default',1)->first();
            $default->status=1;
            $default->save();
        }
        else{
            $data=PriceList::where('status',1)->first();
            $data->status=0;
            $data->save();
        }
        $data=PriceList::findOrFail($request->id);
        $data->start_date=$start_date;
        $data->end_date=$end_date;
        $data->title=$request->title;
        $data->status=$request->status;
        $data->save();
    }

}
