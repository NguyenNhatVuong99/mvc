<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Models\Cashflow;
use App\Models\Product;
use App\Models\Account;
use App\Models\Debt;
use App\Models\Stock;
use App\Models\Partner;
use App\Models\ReceiptCategory;
use App\Models\ReceiptStock;
use App\Models\ReceiptStockDetail;
use App\Models\PriceList;
use App\Http\Requests\ProductImportRequest;
use Datatables;
class ProductImportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     

        
    public function index(Request $request)
    {
        $data=ReceiptStock::productImportIndex();

        if($request->ajax()){
            $data=ReceiptStock::productImportIndex();
            return Datatables::of($data)->make();
        }
        return view('admin.productImport.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['suppliers']=Supplier::get();
        $data['accounts']=Account::get();
        $data['products']=Product::status()->get();
        $data['cat_receipt_stock']=ReceiptCategory::where('code','PN')->first();
        $data['child_cat_receipt_stock']=ReceiptCategory::where('slug','nhap-hang')->first();
        $data['cat_receipt']=ReceiptCategory::where('code','PC')->first();
        $data['child_cat_receipt']=ReceiptCategory::where('slug','chi-nhap-hang')->first();
        $data['partner']=Partner::where('slug','nha-cung-cap')->first();
        return view('admin.productImport.create',$data);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductImportRequest $request)
    {
        if($request->status=='Hoàn thành'){
            Product::updateQuantity($request);
        }
        $receiptStock=ReceiptStock::store($request);
        $request->merge(["document_code"=>$receiptStock[0]]);
        $request->merge(["document_date"=>$receiptStock[1]]);
        $request->merge(["date"=>$receiptStock[1]]);
        ReceiptStockDetail::store($request);
        Cashflow::storeCashflow($request);
        if($request->debt>0){
            $request->merge(["debit"=>$request->debt]);
            $category='CNPC';
            Debt::store($request,$category);
        }
        return response()->json(true);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $data=ReceiptStock::showDetail($request->id);
        
        return response()->json($data);
        
    }
    public function complete(Request $request){
        $receiptStock=ReceiptStock::find($request->id);
        $receiptStock->status="Hoàn thành";
        $receiptStock->save();
        $detail=ReceiptStockDetail::where('receipt_id',$request->id)->get();
        $request->merge(["array"=>$detail]);

        Product::updateQuantity($request);

        return response()->json(true);
    }
    public function receipt(Request $request)
    {
        $receipt=ReceiptCategory::where('code','PC')->first();
        $data=Cashflow::where('document_code',$request->code)->where('cat_id',$receipt->id)->get();
        
        return response()->json($data);
        
    }
    public function createCashflow(Request $request){
        $data['child_cat']=ReceiptCategory::where('name','Chi nhập hàng')->first();
        $data['cat']=ReceiptCategory::where('code','PC')->first();
        $data['receipt']=ReceiptStock::findOrFail($request->id);
        $data['partner']=Partner::index($data['receipt']);
        $data['accounts']=Account::get();

        return response()->json($data);

    }
    public function getCostPrice(Request $request ){
        $data=PriceList::getCostPrice($request->id);
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
