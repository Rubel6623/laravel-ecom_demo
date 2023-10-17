<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Image;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        try {
            $request->validate([
                'category_name'=>['required'],
                'category_image'=>['required']
            ]);
            Category::create([
                'category_name'=>$request->category_name,
                'category_slug'=>strtolower(str_replace('','-',$request->category_name)),
                'category_image'=>$this->uploadImage(request()->file('category_image'))
            ]);
            return redirect()->route('categories.index')->withMessage('category add created successfully?');
        }catch (QueryException $e){
            return  redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('admin.categories.show',['category'=>$category]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit',['category'=>$category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        try {


            $requestData = [
                'category_name'=>$request->category_name,
                'category_slug'=>strtolower(str_replace('','-',$request->category_name)),
                //           'brand_image'=>$this->uploadImage(request()->file('brand_image'))
            ];

            if ($request->hasFile('category_image')){
                $requestData['category_image']=$this->uploadImage(request()->file('category_image'));
            }

            $category->update($requestData);


            return redirect()->route('categories.index')->withMessage('category  updated successfully?');
        }catch (QueryException $e){
            return  redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        try {
            $category->delete();

            return redirect()->route('brands.index')->withMessage('brand deleted successfully?');
        }catch (QueryException $e){
            return  redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }

    public function uploadImage($file)
    {
        $fileName = time().'.'.$file->getClientOriginalExtension();
        Image::make($file)
            ->resize(200,200)->save(storage_path().'/app/public/category/'.$fileName);
        return $fileName;
    }
}
