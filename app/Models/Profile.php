<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table="profiles";
    protected $fillable=['name','user_id','phone','address','ward','province','district','default','urban','region'];
    
    public static function store($request,$user_id){
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
    public static function show($user_id){
        return Profile::where('user_id',$user_id)->get();
    }
    public function province()
    {
        return $this->belongsTo('App\Models\Province');
    }
    public function district()
    {
        return $this->belongsTo('App\Models\District');
    }
    public function ward()
    {
        return $this->belongsTo('App\Models\Ward');
    }
    public function scopeDefault($query){
        return $query->where('default', '1');
    }
    public function scopeStatus($query){
        return $query->where('status', '1');
    }
}
