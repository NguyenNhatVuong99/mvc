<?php

namespace App\Http\Controllers;

use App\Models\CategoryReceipt;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryReceiptRequest;

class CategoryReceiptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(CategoryReceiptRequest $request)
    {
        $cat=new CategoryReceipt();
        $cat->name=$request->name;
        $cat->slug=$request->slug;
        $cat->parent_id=$request->parent_id;
        $cat->status='active';
        $cat->save();
        $id=$cat->id;
        return response()
                ->json($id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CategoryReceipt  $categoryReceipt
     * @return \Illuminate\Http\Response
     */
    public function show(CategoryReceipt $categoryReceipt)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CategoryReceipt  $categoryReceipt
     * @return \Illuminate\Http\Response
     */
    public function edit(CategoryReceipt $categoryReceipt)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CategoryReceipt  $categoryReceipt
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CategoryReceipt $categoryReceipt)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CategoryReceipt  $categoryReceipt
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategoryReceipt $categoryReceipt)
    {
        //
    }
}
