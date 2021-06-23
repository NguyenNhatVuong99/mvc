<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\User;
use Spatie\Permission\Models\Role;
use App\Models\Profile;
use App\Models\Personel;
use Auth;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['roles']=Role::all();
        // $data['category_works']=CategoryWork::get();
        // dd($data);
        if ($request->ajax()) {
            $role=$request->role;
            $branch=$request->branch;
            $query=User::with('roles');
            if(isset($role) && $role!='all'){
                $query=$query->role($role);
            }
          
            $data=$query->orderBy('id','desc')->get();
            return Datatables::of($data)
            ->addColumn('role', function (User $data) {
                return $data->roles;
            })
            ->make(true);
            // return Datatables::of(User::query())->make(true);

        }
        return view('admin.user.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->hasRole('Quản lý')){
            $role=Role::where('name', 'not like', "%Admin%")
                        ->where('name', 'not like', "%Quản lý%")
                        ->where('name', 'not like', "%Khách vãng lai%")
                        ->get();
        }
        else{
            $role=Role::where('name', 'not like', "%Khách vãng lai%")
                        ->get();
        }
        return response()->json($role);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $user=User::store($request);
        return response()->json(true);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($code)
    {
        $data['user']=User::show($code);
        $data['personel']=Personel::show($data['user']->id);
        return view('admin.user.show',$data);
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
