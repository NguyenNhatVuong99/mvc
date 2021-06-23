<?php

namespace App\Http\Controllers\Sell;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SellController extends Controller
{
    public function index(){
        return view('sell.index');
    }
}
