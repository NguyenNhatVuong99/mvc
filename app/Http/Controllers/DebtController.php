<?php

namespace App\Http\Controllers;

use App\Models\Debt;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use App\User;
use App\Models\Supplier;
use Yajra\DataTables\DataTables;

class DebtController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $start='2021-03-13';
        $end='2021-03-13';
        
    }
    public function timeFilter(Request $request){
        $start=date('Y-m-d', strtotime($request->start));
        $end=date('Y-m-d', strtotime($request->end));

            // $data['CNPT']=Debt::with(['user','supplier','child_cat'])
            //                         ->whereBetween(DB::raw('DATE(`created_at`)'), [$start, $end])
            //                         ->where('category','CNPT')
            //                         ->selectRaw("SUM(debit) as total_debit")
            //                         ->selectRaw("SUM(credit) as total_credit")
            //                         ->groupBy('supplier_id')
            //                         ->get();
            $data['CNPC']=Debt::with(['user','supplier'])
                                    ->whereBetween(DB::raw('DATE(`created_at`)'), [$start, $end])
                                    ->where('category','CNPC')
                                    ->selectRaw("SUM(debit) as total_debit")
                                    ->selectRaw("SUM(credit) as total_credit")
                                    ->groupBy('supplier_id')
                                    ->get();
        return response()
        ->json($data);
    }
    public function CNPC(Request $request){
        if($request->ajax()){
            $debts=Debt::CNPC($request);
            return Datatables::of($debts)
            ->addColumn('action', function ($debt) {
                return '<a target="_blank" href="' . route('admin.CNPC.show', $debt->code) .'" class="btn btn-success"><i class="fas fa-eye"></i></a>'; 
            })
            ->rawColumns(['action'])
            ->make(true);
        }

        return view('backend.debt.CNPC.index');
    }
    public function CNPT(Request $request){
        if($request->ajax()){

            $debts=Debt::CNPT($request);
            return Datatables::of($debts)
            ->addColumn('action', function ($debt) {
                return '<a target="_blank" href="' . route('admin.CNPT.show', $debt->code) .'" class="btn btn-success"><i class="fas fa-eye"></i></a>'; 
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('backend.debt.CNPT.index');
    }
    public function CNPCShow($code){
        $data['supplier']=Supplier::where('code',$code)->firstorfail();
        return view('backend.debt.CNPC.show',$data);
    }
    public function CNPTShow($code){
        $data['user']=User::where('code',$code)->firstorfail();
        return view('backend.debt.CNPT.show',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function 
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
     * @param  \App\Debt  $debt
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $data=Debt::show($request);
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Debt  $debt
     * @return \Illuminate\Http\Response
     */
    public function edit(Debt $debt)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Debt  $debt
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Debt $debt)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Debt  $debt
     * @return \Illuminate\Http\Response
     */
    public function destroy(Debt $debt)
    {
        //
    }
}
