<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoryProduct;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class CategoryProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['categories']=CategoryProduct::getAllCategory();
        return view('admin.categoryProduct.index',$data);
    }

    public function create()
    {
        $parent_cats=CategoryProduct::where('is_parent',1)->orderBy('title','ASC')->get();
        return view('admin.categoryProduct.create')->with('parent_cats',$parent_cats);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();
        $this->validate($request,[
            'title'=>'string|required',
            'summary'=>'string|nullable',
            'photo'=>'string|nullable',
            'status'=>'required|in:active,inactive',
            'is_parent'=>'sometimes|in:1',
            'parent_id'=>'nullable|exists:category_products,id',
        ]);
        $data= $request->all();
        $slug=Str::slug($request->title);
        $count=CategoryProduct::where('slug',$slug)->count();
        if($count>0){
            $slug=$slug.'-'.date('ymdis').'-'.rand(0,999);
        }
        $data['slug']=$slug;
        $data['is_parent']=$request->input('is_parent',0);
        // return $data;   
        $status=CategoryProduct::create($data);
        if($status){
            request()->session()->flash('success','Category successfully added');
        }
        else{
            request()->session()->flash('error','Error occurred, Please try again!');
        }
        return redirect()->route('admin.categoryProduct.index');


    }
    public function childCategory(Request $request){
        $child=CategoryProduct::where('parent_id',$request->cat_id)->get();
        return response()->json($child);
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
        $parent_cats=CategoryProduct::where('is_parent',1)->get();
        $category=CategoryProduct::findOrFail($id);
        return view('admin.categoryProduct.edit')->with('category',$category)->with('parent_cats',$parent_cats);
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
        $category=CategoryProduct::findOrFail($id);
        $this->validate($request,[
            'title'=>'string|required',
            'summary'=>'string|nullable',
            'photo'=>'string|nullable',
            'status'=>'required|in:active,inactive',
            'is_parent'=>'sometimes|in:1',
            'parent_id'=>'nullable|exists:category_products,id',
        ]);
        $data= $request->all();
        $data['is_parent']=$request->input('is_parent',0);
        // return $data;
        $status=$category->fill($data)->save();
        if($status){
            request()->session()->flash('success','Category successfully updated');
        }
        else{
            request()->session()->flash('error','Error occurred, Please try again!');
        }
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category=CategoryProduct::findOrFail($id);
        $child_cat_id=CategoryProduct::where('parent_id',$id)->pluck('id');
        // return $child_cat_id;
        $status=$category->delete();
        
        if($status){
            if(count($child_cat_id)>0){
                CategoryProduct::shiftChild($child_cat_id);
            }
            request()->session()->flash('success','Category successfully deleted');
        }
        else{
            request()->session()->flash('error','Error while deleting category');
        }
        return redirect()->route('category.index');
    }

    public function getChildByParent(Request $request){
        // return $request->all();
        $category=CategoryProduct::findOrFail($request->id);
        $child_cat=CategoryProduct::getChildByParentID($request->id);
        // return $child_cat;
        if(count($child_cat)<=0){
            return response()->json(['status'=>false,'msg'=>'','data'=>null]);
        }
        else{
            return response()->json(['status'=>true,'msg'=>'','data'=>$child_cat]);
        }
    }
}
