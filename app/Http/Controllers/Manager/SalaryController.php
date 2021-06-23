<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Branch;
use App\Models\Personel;
use App\Models\Salary;
use App\Models\DetailSalary;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Session;

class SalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data=Salary::branch()->public()->orderBy('id','desc')->get();
            return Datatables::of($data)
            ->make(true);
        }
        return view('manager.payroll.index');
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $data['salary']=Salary::createSalary();
        if($data['salary']==false){
            Session::flash('error','Bạn chưa thể tạo bảng lương tháng tiếp theo');
            return back();
        }
        else{
            $data['personels']=Personel::getPersonelBranch();
            return view('manager.payroll.create',$data);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $salary=Salary::findOrFail($request->id);
        Salary::store($request,$salary);
        return true;

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug,Request $request)
    {
        $data['salary']=Salary::where('slug',$slug)->firstOrFail();
        $data['details']=DetailSalary::with(['personel','personel.user','personel.user.roles'])->where('salary_id',$data['salary']->id)->get();    
        return view('manager.payroll.show',$data);

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
    public function update(Request $request)
    {
        $salary=Salary::findOrFail($request->id);
        Salary::updateSalary($request,$salary);
        $details=DetailSalary::with(['personel','personel.user','personel.user.roles'])->where('salary_id',$request->id)->get();    

        return response()->json($details);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function status(Request $request){
        $salary=Salary::findOrFail($request->id);
        if(isset($request->isPay)){
            $salary->isPay=$request->isPay;
        }
        if(isset($request->isPublic)){
            $salary->isPublic=$request->isPublic;
        }
        $salary->save();
        return $salary;
    }
    public function destroy($id)
    {
        Salary::findOrFail($id);
        Salary::destroy($id);

        return true;
    }
}
