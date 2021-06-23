<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Banner extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable=['title','description','photo','status'];
    public function scopeStatus($query)
    {
        return $query->where('status', 1);
    }
    public static function create($request){
        $banner=new Banner();
        $banner->title=$request->title;
        $banner->description=$request->description;
        $banner->photo=$request->photo;
        $banner->status=$request->status;
        $banner->save();
    }
    public static function updateBanner($request){
        $banner=Banner::findOrFail($request->id);
        $banner->title=$request->title;
        $banner->description=$request->description;
        $banner->photo=$request->photo;
        $banner->save();
    }
    public static function updateStatus($request){
        $banner=Banner::findOrFail($request->id);
        $banner->status=(int)$request->status;
        $banner->save();
    }
    public static function destroy($id){
        $banner=Banner::findOrFail($id);
        $banner->delete($id);
    }
    public static function restore($id){
        Banner::withTrashed()->where('id', $id)->restore();
    }
   

}
