<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\User;
use Spatie\Permission\Models\Role;
use App\Models\Profile;
use App\Models\Personel;
use App\Models\CategoryWork;
use App\Models\Branch;
use Auth;
use App\Enums\TypeSalary;
use App\Http\Requests\UserRequest;
class PersonelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        dd('olk');
        $data['roles']=Role::where('isPersonel',1)->get();
        $data['branches']=Branch::index();
        $data['category_works']=CategoryWork::get();
        $data['type_salaries']=json_encode(TypeSalary::toSelectArray());
        if ($request->ajax()) {
            $data=Personel::datatable($request);
            return Datatables::of($data)
            ->make(true);
        }
        return view('backend.personel.index',$data);
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
     * @param  \App\Models\Personel  $personel
     * @return \Illuminate\Http\Response
     */
    public function show(Personel $personel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Personel  $personel
     * @return \Illuminate\Http\Response
     */
    public function edit($code)
    {
        $data=Personel::edit($code);
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Personel  $personel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Personel $personel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Personel  $personel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Personel $personel)
    {
        //
    }
}
