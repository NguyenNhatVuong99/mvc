<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PriceList;
use App\Models\PriceListDetail;
use App\Models\PriceListFormat;
use App\Http\Requests\PriceListRequest;
use App\Http\Requests\FormatRequest;
use Yajra\DataTables\DataTables;
use App\Enums\ParentPriceFormatEnum;
use App\Enums\CalculationFormatEnum;
use App\Enums\TypeFormatEnum;
// use Response;
use Illuminate\Support\Facades\Response;
class PriceListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data=PriceList::get();
            return response()->json($data);
        }
        return view('admin.priceList.index');
    }
    public function getFormat(Request $request){
        $data['parent_prices']=ParentPriceFormatEnum::getKeys();
        $data['calculations']=CalculationFormatEnum::getKeys();
        $data['types']=TypeFormatEnum::getKeys();
        $data['formats']=PriceListFormat::with('priceList')->where('price_list_id',$request->id)->firstOrFail();
        return response()->json($data);
    }
    public function updateFormat(FormatRequest $request){
        $price_list_id=PriceListFormat::updateFormat($request);
        $detail=PriceListDetail::where('price_list_id',$price_list_id)->where('isPromotion',1)->get();
        if(!$detail->isEmpty()){
            PriceListDetail::updateProduct($detail);
        }
        return response()->json(true);
    }
    public function updateDetail(Request $request){
        $result=PriceListDetail::updateDetail($request);
        
        if($result[0]==404){
            return response()->json(['error' => $result[1],'type'=>'error']);
        }
        else{
            return response()->json($result);

        }
    }
    public function deleteProduct(Request $request){
        PriceListDetail::deleteProduct($request);
        return response()->json(true);

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(PriceListRequest $request)
    public function store(PriceListRequest $request)
    {
        $id=PriceList::store($request);
        PriceListFormat::store($id);
        PriceListDetail::store($id);
        return response()->json(true);
    }
    public function detail(Request $request)
    {
        if($request->ajax()){
            $priceList=PriceList::findOrFail($request->id);
            if($priceList->default==1){
                $data=PriceListDetail::with('priceList','product')->where('price_list_id',$priceList->id)->get();
            }
            else{
                $data=PriceListDetail::with('priceList','product')->promotion()->where('price_list_id',$priceList->id)->get();
            }
            return Datatables::of($data)->make();
        }
    }
    public function getProduct(Request $request){
        $data=PriceListDetail::with('priceList','product')->where('price_list_id',$request->id)->where('isPromotion',0)->get();
        return response()->json($data);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $data=PriceList::findOrFail($request->id);
        return response()->json($data);

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
    public function update(PriceListRequest $request, $id)
    {
        PriceList::updatePriceList($request);
        return response()->json(true);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        PriceList::destroy($request->id);
        PriceListFormat::destroy($request->id);
        PriceListDetail::destroy($request->id);
        return response()->json(true);
    }
    public function updatePrice(Request $request){
        PriceListDetail::updatePrice($request);
        return response()->json(true);

    }
}
