<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Partner;
class PartnerController extends Controller
{
    public function index(Request $request){
        $data=Partner::index($request);
        return response()->json($data);
    }
}
