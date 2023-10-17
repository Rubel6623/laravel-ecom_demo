<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Image;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brands = Brand::latest()->get();
        $categories = Category::latest()->get();
        return view('admin.products.create',compact('brands','categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'product_name'=>['required'],
                'price'=>['required']
            ]);
            Product::create([
                'brand_name'=>$request->brand_name,
                'category_name'=>$request->category_name,
                'product_name'=>$request->product_name,
                'description'=>$request->description,
                'image' => $this->uploadImage(request()->file('image')),
                'price'=>$request->price,
                'status'=>1,
                'created_at'=>Carbon::now(),
            ]);
            return redirect()->route('products.index')->withMessage('product add created successfully?');
        }catch (QueryException $e){
            return  redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('admin.products.show',[
            'product'=>$product
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $brands = Brand::latest()->get();
        $categories = Category::latest()->get();
        return view('admin.products.edit',['product'=>$product],compact('brands','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        try {


            $requestData = [

                'brand_name'=>$request->brand_name,
                'category_name'=>$request->category_name,
                'product_name'=>$request->product_name,
                'description'=>$request->description,
                //'image' => $this->uploadImage(request()->file('image')),
                'price'=>$request->price,
                'status'=>1,
                'created_at'=>Carbon::now(),
            ];

            if ($request->hasFile('image')){
                $requestData['image']=$this->uploadImage(request()->file('image'));
            }

            $product->update($requestData);


            return redirect()->route('products.index')->withMessage('product  updated successfully?');
        }catch (QueryException $e){
            return  redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try {
            $product->delete();

            return redirect()->route('products.index')->withMessage('brand deleted successfully?');
        }catch (QueryException $e){
            return  redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }


    public function ProductInactive($id)
    {
        Product::findOrFail($id)->update(['status' => 0]);
        return redirect()->route('products.index');
    }

    public function ProductActive($id)
    {
        Product::findOrFail($id)->update(['status' => 1]);
        return redirect()->route('products.index');
    }


    public function uploadImage($file)
    {
        $fileName = time().'.'.$file->getClientOriginalExtension();
        Image::make($file)
            ->resize(800,800)->save(storage_path().'/app/public/product/'.$fileName);
        return $fileName;
    }
}
