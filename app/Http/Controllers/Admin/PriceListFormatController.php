<?php

namespace App\Http\Controllers;

use App\Models\PriceListFormat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PriceListFormatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data=PriceListFormat::where('price_list_id',$request->id)->find();
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PriceListFormat  $priceListFormat
     * @return \Illuminate\Http\Response
     */
    public function show(PriceListFormat $priceListFormat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PriceListFormat  $priceListFormat
     * @return \Illuminate\Http\Response
     */
    public function edit(PriceListFormat $priceListFormat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PriceListFormat  $priceListFormat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PriceListFormat $priceListFormat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PriceListFormat  $priceListFormat
     * @return \Illuminate\Http\Response
     */
    public function destroy(PriceListFormat $priceListFormat)
    {
        //
    }
}
