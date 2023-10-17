<x-admin.layouts.admin_master>

    <div class="card-header">
        Edit brand <a class="btn btn-info" href="{{route('products.index')}}">List</a>
    </div>

    <div class="card-body">
        <form action="{{route('products.update',['product'=>$product->id])}}" method="post"  enctype="multipart/form-data">
            @csrf
            @method('patch')

            <div class="mb-3 row">
                <label for="inputTitle" class="col-sm-3 col-form-label">ProductName</label>
                <div class="col-sm-9">
                    <input
                        type="text"
                        class="form-control"
                        id="inputTitle"
                        name="product_name"
                        value="{{$product->product_name}}">
                </div>
            </div>










            <div class="mb-3 row">
                <label for="inputTitle" class="col-sm-3 col-form-label">Price</label>
                <div class="col-sm-9">
                    <input
                        type="text"
                        class="form-control"
                        id="inputTitle"
                        name="price"
                        value="{{$product->price}}">
                </div>
            </div>


            <div class="mb-3 row">
                <label for="inputImg" class="col-sm-3 col-form-label">Picture</label>
                <div class="col-sm-9">
                    <input
                        type="file"
                        class="form-control"
                        id="inputImg"
                        name="image"
                        value="">
                  <img src="/storage/product/{{$product->image}}" style="width: 70px;height: 40px">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="inputTitle" class="col-sm-3 col-form-label">Brand</label>
                <div class="col-sm-9">
                    <select name="brand_id" class="form-select">
                        <option></option>
                        @foreach($brands as $brand)
                            <option value="{{$brand->id}}"{{$brand->id == $product->brand_id ? 'selected':''}}>{{$brand->brand_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mb-3 row">
                <label for="inputTitle" class="col-sm-3 col-form-label">Category</label>
                <div class="col-sm-9">
                    <select name="category_id" class="form-select">
                        <option></option>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}"{{$category->id == $product->category_id ? 'selected':''}}>{{$category->category_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
<div class="mb-3">
    <div class="col-sm-8">
        <button type="submit" class="btn btn-info">update</button>
    </div>
</div>

        </form>
    </div>

</x-admin.layouts.admin_master>

