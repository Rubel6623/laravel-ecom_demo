<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Image;
class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::all();
        return view('admin.brands.index',compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'brand_name'=>['required'],
                'brand_image'=>['required']
            ]);
            Brand::create([
                'brand_name'=>$request->brand_name,
                'brand_slug'=>strtolower(str_replace('','-',$request->brand_name)),
                'brand_image'=>$this->uploadImage(request()->file('brand_image'))
            ]);
            return redirect()->route('brands.index')->withMessage('brand add created successfully?');
        }catch (QueryException $e){
            return  redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        return view('admin.brands.show',['brand'=>$brand]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        return view('admin.brands.edit',['brand'=>$brand]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brand $brand)
    {
        try {


            $requestData = [
                'brand_name'=>$request->brand_name,
                'brand_slug'=>strtolower(str_replace('','-',$request->brand_name)),
                //           'brand_image'=>$this->uploadImage(request()->file('brand_image'))
            ];

            if ($request->hasFile('brand_image')){
                $requestData['brand_image']=$this->uploadImage(request()->file('brand_image'));
            }

            $brand->update($requestData);


            return redirect()->route('brands.index')->withMessage('brand  updated successfully?');
        }catch (QueryException $e){
            return  redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        try {
            $brand->delete();

            return redirect()->route('brands.index')->withMessage('brand deleted successfully?');
        }catch (QueryException $e){
            return  redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }


    public function uploadImage($file)
    {
        $fileName = time().'.'.$file->getClientOriginalExtension();
        Image::make($file)
            ->resize(200,200)->save(storage_path().'/app/public/brand/'.$fileName);
        return $fileName;
    }
}
