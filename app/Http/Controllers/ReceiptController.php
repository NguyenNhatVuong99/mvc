<?php

namespace App\Http\Controllers;

use App\Models\Receipt;
use App\Models\CategoryReceipt;
use App\Models\ReceiptStock;
use Illuminate\Http\Request;
use DB;
use Yajra\DataTables\DataTables;

class ReceiptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            // dd($request);
            $data=Receipt::index($request);
            return  $data;
        }
        // $PC=CategoryReceipt::where('code','PC')->firstOrFail();
        // $PT=CategoryReceipt::where('code','PT')->firstOrFail();
        // $data['PC_category']=CategoryReceipt::where('parent_id',$PC->id)->get();
        // $data['PT_category']=CategoryReceipt::where('parent_id',$PT->id)->get();
        // $data['debt']=ReceiptStock::where('debt','>',0)->get();
        // return view('backend.receipt.index',$data);

    }
    public function PC(Request $request){
        if($request->ajax()){
            $data=Receipt::PC($request);
            return  $data;
        }
        $PC=CategoryReceipt::where('code','PC')->firstOrFail();
        $data['PC_category']=CategoryReceipt::where('parent_id',$PC->id)->get();
        $data['debt']=ReceiptStock::where('debt','>',0)->where('cat_id',3)->get();
                return view('backend.receipt.PC',$data);
        // $PC=CategoryReceipt::where('code','PC')->firstOrFail();
        // $data['PC_category']=CategoryReceipt::where('parent_id',$PC->id)->get();
        // $data['debt']=ReceiptStock::where('debt','>',0)->get();
        // return view('backend.receipt.PC',$data);

    }
    public function PT(Request $request){
        if($request->ajax()){
            $data=Receipt::PT($request);
            return  $data;
        }
        $PT=CategoryReceipt::where('code','PT')->firstOrFail();
        $data['PT_category']=CategoryReceipt::where('parent_id',$PT->id)->get();
        $data['debt']=ReceiptStock::where('debt','>',0)->get();
                return view('backend.receipt.PT',$data);

    }
    public function updateStatus(Request $request){
        Receipt::updateStatus($request);
        return response()
        ->json(true);
    }
    public function datatable(Request $request){
        dd($request->all());
        if($request->ajax()){
            dd($request->all());
        }
        else{
            dd('ok');
        }
        // $cat=DB::table('category_receipts')->where('code',$request->cat)->first();
        // $receipts=Receipt::with(['user','supplier','child_cat'])->where('cat_id',$cat->id)->orderBy('created_at','desc')->get();
        // return DataTables::of($receipts)->make(true);
    }
    public function timeFilter(Request $request){
        $cat=CategoryReceipt::where('code',$request->cat)->firstOrFail();
        $start=date('Y-m-d', strtotime($request->start));
        $end=date('Y-m-d', strtotime($request->end));
            
            $data['receipts']=Receipt::with(['user','supplier','child_cat'])
                                    ->whereBetween(DB::raw('DATE(`created_at`)'), [$start, $end])
                                    ->where('cat_id',$cat->id)
                                    ->orderBy('created_at','desc')
                                    ->get();

        return response()
        ->json($data);
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
        Receipt::store($request);
        return response()
        ->json(true);
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Receipt  $receipt
     * @return \Illuminate\Http\Response
     */
    public function show(Receipt $receipt)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Receipt  $receipt
     * @return \Illuminate\Http\Response
     */
    public function edit(Receipt $receipt)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Receipt  $receipt
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Receipt $receipt)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Receipt  $receipt
     * @return \Illuminate\Http\Response
     */
    public function destroy(Receipt $receipt)
    {
        //
    }
}
