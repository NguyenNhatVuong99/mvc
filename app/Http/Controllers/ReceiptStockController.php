<?php

namespace App\Http\Controllers;

use App\Models\ReceiptStock;
use App\User;
use App\Models\Supplier;
use App\Models\Receipt;
use App\Models\DetailReceiptStock;
use App\Models\Stock;
use App\Models\Product;
use App\Models\Debt;
use App\Models\DetailDebt;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use App\Http\Requests\ReceiptStockRequest;
use DB;
use Yajra\DataTables\DataTables;
use App\Models\Partner;
use App\Models\CategoryReceipt;

class ReceiptStockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function getPN(Request $request){
        if($request->ajax()){
            $data=ReceiptStock::datatable($request);
            return Datatables::of($data)
            ->addColumn('slug', function (ReceiptStock $data) {
                return ($data->partner!=null) ? $data->partner->slug : '';
            })
            ->make(true);
        }
        return view('backend.receipt-stock.PN.index');
    }
    public function getPX(Request $request){
        if($request->ajax()){
            $data=ReceiptStock::datatable($request);
            return Datatables::of($data)
            ->addColumn('user', function (ReceiptStock $data) {
                return ($data->user!=null) ? $data->user->name : '';
            })
            ->addColumn('', function (ReceiptStock $data) {
                return ($data->user!=null) ? $data->user->name : '';
            })
            ->make(true);
        }
        return view('backend.receipt-stock.PX.index');
    }
    public function datatable(Request $request){

    }
    public function index()
    {
        $PN=DB::table('category_receipts')->where('code','PN')->first();
        $PX=DB::table('category_receipts')->where('code','PX')->first();
        $data['PN']=ReceiptStock::with(['user','supplier','category'])->where('cat_id',$PN->id)->get();
        $data['PX']=ReceiptStock::with(['user','supplier','category'])->where('cat_id',$PX->id)->get();
        
        return view('backend.receipt-stock.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function createPN()
    {
        $data['suppliers']=Supplier::get();
        $data['products']=Product::with(['stock'])->get();
        $data['child_cat_id']=CategoryReceipt::where('slug','nhap-hang')->select('id')->first();
        return view('backend.receipt-stock.PN.create',$data);
    }
    public function createPX(Request $request)
    {
        // $data['suppliers']=Supplier::get();
        if($request->ajax()){
            $data=Partner::getPartner($request->slug);
            return response()
                ->json($data);
        }
        $data['partners']=Partner::get();
        $data['products']=Product::where('quantity','>',0)->get();
        $cat=CategoryReceipt::where('code','PX')->first();
        $data['category_receipts']=CategoryReceipt::where('parent_id',$cat->id)->get();
        $data['parent_id']=$cat->id;
        return view('backend.receipt-stock.PX.create',$data);
    }
    public function stockBalance(Request $request){
        if($request->ajax()){
            $data=ReceiptStock::balance($request);
        };
        return view('backend.receipt-stock.balance');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
public function store(ReceiptStockRequest $request)
    {
        $receipt=ReceiptStock::store($request);
        return response()
                ->json(true);

    }
    public function getDebt(Request $request){
        $debt=ReceiptStock::where('code',$request->code)->first();
        return response()
                ->json($debt);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($code)
    {
        $data['receipt']=ReceiptStock::with(['detail'])->where('code', $code)->firstOrFail();
        return view('backend.order.show',$data);

    }
    public function outOfStock(Request $request){
        $outOfStock=ReceiptStock::outOfStock($request->id);
        return response()
        ->json(true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brand=Brand::get();
        $data['receipts']=ReceiptStock::findOrFail($id);
        $category=Category::where('is_parent',1)->get();
        $items=ReceiptStock::where('id',$id)->get();
        // return $items;
        return view('backend.receipt-stock.edit')->with('product',$product)
                    ->with('brands',$brand)
                    ->with('categories',$category)->with('items',$items);
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
        $data['receipts']=ReceiptStock::findOrFail($id);
        $this->validate($request,[
            'title'=>'string|required',
            'summary'=>'string|required',
            'description'=>'string|nullable',
            'photo'=>'string|required',
            'size'=>'nullable',
            'stock'=>"required|numeric",
            'cat_id'=>'required|exists:categories,id',
            'child_cat_id'=>'nullable|exists:categories,id',
            'is_featured'=>'sometimes|in:1',
            'brand_id'=>'nullable|exists:brands,id',
            'status'=>'required|in:active,inactive',
            'condition'=>'required|in:default,new,hot',
            'price'=>'required|numeric',
            'discount'=>'nullable|numeric'
        ]);

        $data=$request->all();
        $data['is_featured']=$request->input('is_featured',0);
        $size=$request->input('size');
        if($size){
            $data['size']=implode(',',$size);
        }
        else{
            $data['size']='';
        }
        // return $data;
        $status=$product->fill($data)->save();
        if($status){
            request()->session()->flash('success','Product Successfully updated');
        }
        else{
            request()->session()->flash('error','Please try again!!');
        }
        return redirect()->route('receipt-stock.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data['receipts']=ReceiptStock::findOrFail($id);
        $status=$product->delete();
        
        if($status){
            request()->session()->flash('success','Product successfully deleted');
        }
        else{
            request()->session()->flash('error','Error while deleting product');
        }
        return redirect()->route('receipt-stock.index');
    }
}
