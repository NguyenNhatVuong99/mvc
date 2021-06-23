<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
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
            dd('ok');
            $data=Salary::get();

            return Datatables::of($data)
             ->make(true);
        }
        return view('admin.payroll.index');
         
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function show($slug,Request $request)
    {
        $data['salary']=Salary::where('slug',$slug)->firstOrFail();
        $data['details']=DetailSalary::with(['personel','personel.user','personel.user.roles'])->where('salary_id',$data['salary']->id)->get();    
        return view('admin.payroll.show',$data);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function edit(Salary $salary)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Salary $salary)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function destroy(Salary $salary)
    {
        //
    }
}
