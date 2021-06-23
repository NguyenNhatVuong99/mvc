<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Profile;
use App\Http\Requests\AddressRequest;
class UserAddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id=Auth::id();
        $data['profiles']=Profile::where('user_id',$user_id)->get();
        return view('user.address',$data);
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
    public function store(AddressRequest $request)
    {
        $province=implode(',',$request->province);
        $district=implode(',',$request->district);
        $ward=implode(',',$request->ward);
        $profile=new Profile();
        $profile->user_id=Auth::id();
        $profile->name=$request->name;
        $profile->phone=$request->phone;
        $profile->address=$request->address;
        $profile->urban=$request->urban;
        $profile->region=$request->region;
        $profile->province=$province;
        $profile->district=$district;
        $profile->ward=$ward;
        $profile->save();
        return response()->json(true);
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $profile=Profile::findOrFail($id);
        return response()->json($profile);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AddressRequest $request, $id)
    {
        $province=implode(',',$request->province);
        $district=implode(',',$request->district);
        $ward=implode(',',$request->ward);
        $profile= Profile::findOrFail($id);
        $profile->user_id=Auth::id();
        $profile->name=$request->name;
        $profile->phone=$request->phone;
        $profile->address=$request->address;
        $profile->urban=$request->urban;
        $profile->region=$request->region;
        $profile->province=$province;
        $profile->district=$district;
        $profile->ward=$ward;
        $profile->save();
        return response()->json(true);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $count=Profile::where('user_id',Auth::id())->count();
        dd($count);
        if($count>1){
            $profile=Profile::findOrFail($id);
            if($profile->default==1){
                $item=Profile::where('user_id',Auth::id())->first();
                $item->default=1;
                $item->save();
            }
            $profile->delete();
            return response()->json(true);
        }
        else{
            return response()->json(false);

        }

        

    }
    public function default(Request $request){
        $profile=Profile::findOrFail($request->id);
        if($profile->default==0){
            $item=Profile::where('default','1')->where('user_id',Auth::id())->first();
            $item->default=0;
            $item->save();
            $profile->default=1;
            $profile->save();
            return response()->json(true);

        }
    }
}
