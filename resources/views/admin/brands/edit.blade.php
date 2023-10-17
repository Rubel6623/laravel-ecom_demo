<x-admin.layouts.admin_master>

    <h1 class="h3 mb-3"> brand</h1>

    <div class="card-header">
        Edit brand <a class="btn btn-info" href="{{route('brands.index')}}">List</a>
    </div>

    <div class="card-body">
        <form action="{{route('brands.update',['brand'=>$brand->id])}}" method="post"         enctype="multipart/form-data">

            @csrf
            @method('patch')
            <div class="mb-3">
                <label for="inputTitle" class="col-sm-3 col-form-label">Title</label>
                <div class="col-8">
                    <input type="text"
                           class="form-control"
                           id="inputTitle"
                           name="brand_name"
                           value="{{old('brand_name',$brand->brand_name)}}">

                </div>
            </div>

            <div class="mb-3">
                <label for="inputPicture" class="col-sm-3 col-form-label">Picture</label>
                <div class="col-8">
                    <input type="file"
                           class="form-control"
                           id="inputPicture"
                           name="brand_image"
                           value="">
                    <img src="/storage/brand/{{$brand->brand_image}}" style="width: 70px;height: 40px">


                    @error('brand_image')
                    <div class="alert alert-danger text-danger">{{ $message }}</div>
                    @enderror

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

