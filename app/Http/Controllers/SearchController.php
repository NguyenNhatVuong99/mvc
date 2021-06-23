<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class SearchController extends Controller
{
    public function searchSupplier(Request $request){
            $data=DB::table('suppliers')->where('name', 'LIKE', '%' . $request->search . '%')->get();
            return json_encode($data);

    }
}
