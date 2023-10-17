<x-admin.layouts.admin_master>

    <h1 class="h3 mb-3"> category</h1>

    <div class="card-header">
        Edit category <a class="btn btn-info" href="{{route('categories.index')}}">List</a>
    </div>

    <div class="card-body">
        <form action="{{route('categories.update',['category'=>$category->id])}}" method="post"         enctype="multipart/form-data">

            @csrf
            @method('patch')
            <div class="mb-3">
                <label for="inputTitle" class="col-sm-3 col-form-label">Title</label>
                <div class="col-8">
                    <input type="text"
                           class="form-control"
                           id="inputTitle"
                           name="category_name"
                           value="{{old('category_name',$category->category_name)}}">

                </div>
            </div>

            <div class="mb-3">
                <label for="inputPicture" class="col-sm-3 col-form-label">Picture</label>
                <div class="col-8">
                    <input type="file"
                           class="form-control"
                           id="inputPicture"
                           name="category_image"
                           value="{{old('category_image',$category->category_image)}}">

                    @error('category_image')
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

