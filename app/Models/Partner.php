<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Models\Supplier;
use App\Models\Profile;
class Partner extends Model
{
    protected $table='partners';
    protected $fillable=['name','slug'];
    public static function index($request){
        $partner=Partner::find($request->partner_id);
        switch ($partner->slug) {
            case "khach-hang":
                $data['partners']=User::role('user')->status()->get();
                $data['type']='Khách hàng';
            break;
            case "nha-cung-cap":
                 return $data=Supplier::where('code',$request->partner_code)->status()
                                    ->get(['name AS supplier_name', 'code AS supplier_code'])->first();
                // $data=$partner->name;
            break;
            case "khac":
            echo "Your favorite color is green!";
            break;
            default:
            echo "Your favorite color is neither red, blue, nor green!";
        }
    }
    public static function getPartner($partner_id,$partner_code){
        dd($partner_id);
    }
    // public static function getPartner($slug){
    //     switch ($slug) {
    //         case "khach-hang":
    //             $data['partners']=User::role('user')->status()->orderBy('created_at', 'DESC')->get();
    //             $data['type']='Khách hàng';
    //         break;
    //         case "nha-cung-cap":
    //             $data['partners']=Supplier::status()->orderBy('created_at', 'DESC')->get();
    //             $data['type']='Nhà cung cấp';
    //         break;
    //         case "khac":
    //         echo "Your favorite color is green!";
    //         break;
    //         default:
    //         echo "Your favorite color is neither red, blue, nor green!";
    //     }
    //     return $data;
    // }
    // public static function show($request){
    //     switch ($request->type) {
    //         case "Khách hàng":
    //             $data['user']=User::where('code',$request->code)->firstOrFail();
    //             $data['profiles']=Profile::where('user_id',$data['user']->id)->get();
    //             $data['type']='Khách hàng';
    //         break;
    //         case "nha-cung-cap":
    //             $data['suppliers']=Supplier::where('code',$request->code)->firstOrFail();
    //             $data['type']='Nhà cung cấp';
    //         break;
    //         case "khac":
    //         echo "Your favorite color is green!";
    //         break;
    //         default:
    //         echo "Your favorite color is neither red, blue, nor green!";
    //     }
    //     return $data;
    // }
}
