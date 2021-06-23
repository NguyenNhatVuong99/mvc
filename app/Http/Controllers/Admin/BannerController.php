<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Banner;
use Illuminate\Support\Str;
use Datatables;
use App\Http\Requests\BannerRequest;
class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data=Banner::orderBy('id','DESC');
            return Datatables::of($data)->make();
        }
        return view('admin.banner.index');
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
    public function store(BannerRequest $request)
    {
        Banner::create($request);
        return response()->json(true);
        // return redirect()->route('banner.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $banner=Banner::findOrFail($id);
        return $banner;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function edit($id)
    // {
    //     $banner=Banner::findOrFail($id);
    //     return view('backend.banner.edit')->with('banner',$banner);
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BannerRequest $request)
    {
        Banner::updateBanner($request);
        return true;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $type=$request->type;
        if($type=='forceDelete'){
            Banner::withTrashed()->where('id', $request->id)->forceDelete();
        }
        else if($type=='multiple'){
            Banner::whereIn('id',$request->array)->delete();
        }
        else{
            $banner=Banner::findOrFail($request->id);
            $banner->delete($request->id);
        }
    }
    public function updateStatus(Request $request){
        Banner::updateStatus($request);
        return response()->json(true);
    }
    public function onlyTrashed(Request $request){
        if($request->ajax()){
            $data=Banner::onlyTrashed()->get();
            return Datatables::of($data)->make();
        }
    }
    public function restore(Request $request){
        Banner::restore($request->id);
    }
}
