<?php

namespace App\Http\Controllers;

use App\Models\ServiceShip;
use App\Models\RouteShip;
use Illuminate\Http\Request;
use App\Http\Requests\ServiceShipRequest;
class ServiceShipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['services']=ServiceShip::get();
        $data['routes']=RouteShip::get();
        return view('backend.ship.index',$data);
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
     * @param  \App\Models\ServiceShip  $serviceShip
     * @return \Illuminate\Http\Response
     */
    public function show(ServiceShip $serviceShip)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ServiceShip  $serviceShip
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $service=ServiceShip::findOrFail($id);
        return response()->json($service);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ServiceShip  $serviceShip
     * @return \Illuminate\Http\Response
     */
    public function update(ServiceShipRequest $request,$id)
    {
        $service=ServiceShip::findOrFail($id);
        $service->weight=$request->weight;
        $service->urban=$request->urban;
        $service->suburban=$request->suburban;
        $service->more_weight=$request->more;
        $service->time=$request->time;
        $service->save();
        return response()->json(true);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ServiceShip  $serviceShip
     * @return \Illuminate\Http\Response
     */
    public function destroy(ServiceShip $serviceShip)
    {
        //
    }
}
