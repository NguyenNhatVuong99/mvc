<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $table="branches";
    protected $fillable=['phone','email','province','ward','district','status','address','isMain'];
    public static function index(){
        return Branch::status()->get();
    }
    public function scopeStatus($query)
    {
        return $query->where('status', 1);
    }
    public static function vn_to_str ($str){
 
        $unicode = array(
         
        'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
         
        'd'=>'đ',
         
        'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
         
        'i'=>'í|ì|ỉ|ĩ|ị',
         
        'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
         
        'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
         
        'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
         
        'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
         
        'D'=>'Đ',
         
        'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
         
        'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
         
        'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
         
        'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
         
        'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
         
        );
         
        foreach($unicode as $nonUnicode=>$uni){
         
        $str = preg_replace("/($uni)/i", $nonUnicode, $str);
         
        }
        $str = str_replace(' ',' ',$str);
        return $str;
    }   
    public static function store($request){
        $province=explode(',', $request->province);
        $code='CS';
        $str = Branch::vn_to_str(trim($province[1]));
        $arr=explode(' ',$str);
        foreach($arr as $key => $item){
            $code.=$item[0];
        }
        if($code=="CSHCM"){
            $code="CSTPHCM";
            $request->province='79,Tp Hồ Chí Minh';

        }
        $branch= new Branch();
        $branch->name= $request->name;
        $branch->email= $request->email;
        $branch->phone= $request->phone;
        $branch->address= $request->address;
        $branch->province= $request->province;
        $branch->district= $request->district;
        $branch->ward= $request->ward;
        $branch->isMain= $request->isMain;
        
        $branch->code= '';
        $branch->save();
        $id=$branch->id;
        if(strlen($id)<2){
            $code.=0;
            $code.=$id;
        }
        else{
            $code.=$id;
        }
        $branch->code=$code;
        $branch->save();
    }
    // public function scopeStatus($query){
    //     return t
    // }
}
