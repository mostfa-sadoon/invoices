<?php

namespace App\Http\Controllers;

use App\Product;
use App\Section;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProductUpdate;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $sections=Section::all();
        $products=Product::all();
        return view('products.products',compact('sections','products'));
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
    public function store(ProductRequest $request)
    {
        //
        Product::create([
           "product_name"=>$request->Product_name,
           'description'=>$request->description,
           "section_id"=>$request->section_id,
        ]);
        session()->flash('add',"تم اضافه المنتج بنجاح");
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductUpdate $request)
    {
        //
        $section_id=Section::where('section_name',$request->section_name)->first()->id;
       $product=Product::findorFail($request->pro_id);
       $product->update([
          "product_name"=>$request->Product_name,
          'description'=>$request->description,
          'section_id'=>$section_id
       ]);
       session()->flash('update',"تم التعديل بنجاح");
       return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        $product=Product::findorfail($request->pro_id);
        $product->delete();
        session()->flash('delete',"تم حذف المنتج بنجاح");
         return redirect()->back();
    }
}
