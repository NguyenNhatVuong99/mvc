<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CashflowRequest;
use App\Models\Debt;
use App\Models\Supplier;
use App\Models\Partner;
use App\Models\ReceiptStock;
use App\Models\Cashflow;

class CashflowController extends Controller
{
    
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CashflowRequest $request)
    {
        Cashflow::storeCashflow($request);
        $partner=Partner::find($request->partner_id);
        switch ($partner->slug) {
            case "nha-cung-cap":
                Supplier::updateDebt($request);
                ReceiptStock::updateDebt($request);
                $request->merge(["credit"=>$request->payment]);
                $category='CNPC';
                Debt::store($request,$category);
            break;
        }
        
        return response()->json(true);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
