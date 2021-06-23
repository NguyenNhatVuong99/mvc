<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Personel;
class StaffController extends Controller
{
    public function index(){
        $user_id=Auth::user()->id;
        $data['personel']=Personel::show($user_id);
        return view('backend.user.show',$data);
    }
}
