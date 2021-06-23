<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Receipt;
use App\Models\CategoryReceipt;
use DB;
use Auth;
class PCController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data['PC']=Receipt::getPC();
        $data['PC']=DB::table('receipts')->where('cat_id','2')->get();
        $data['categories']=CategoryReceipt::where('parent_id','2')->get();

        return view('backend.PC.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['categories']=CategoryReceipt::where('parent_id','2')->get();
        return view('backend.PC.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $date=date('Y-m-d H:i:s', strtotime($request->date));
        $receipt=new Receipt();
        $receipt->total=$request->total;
        $receipt->date=$date;
        $receipt->note=$request->note;
        $receipt->user_id=Auth::user()->id;
        $receipt->cat_id='2';
        $receipt->status='Hoàn thành';
        $receipt->child_cat_id=$request->child_cat_id;
        $receipt->save();
        $id=$receipt->id;
        $count=6;
        $lengthId=strlen($id);
        $length=$count-$lengthId;
        $str='PC';
        for($i=0; $i<$length; $i++){
            $str.='0';
        }
        $code=$str.$id;
        $receipt->code=$code;
        $receipt->save();
        return response()
                ->json($id);

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
    public function print($id)
    {
        $data['receipt']=Receipt::findOrFail($id);
        return view('backend.print.receipt',$data);
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
