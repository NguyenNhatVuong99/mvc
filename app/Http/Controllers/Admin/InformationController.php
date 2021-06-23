<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Information;
class InformationController extends Controller
{
    public function index(){
        $data['informations']=Information::first();
        return view('backend.information',$data);
    }
}
