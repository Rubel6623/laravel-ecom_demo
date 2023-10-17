<x-admin.layouts.admin_master>

    <div class="card-header">
        Edit brand <a class="btn btn-info" href="{{route('sliders.index')}}">List</a>
    </div>

    <div class="card-body">
        <form action="{{route('sliders.update',['slider'=>$slider->id])}}" method="post"  enctype="multipart/form-data">

            @csrf
            @method('patch')
            <div class="mb-3">
                <label for="inputTitle" class="col-sm-3 col-form-label">SliderTitle</label>
                <div class="col-8">
                    <input type="text"
                           class="form-control"
                           id="inputTitle"
                           name="slider_title"
                           value="{{old('slider_title',$slider->slider_title)}}">
                    @error('slider_title')
                    <p class="text-danger">{{$message}}</p>
                    @enderror

                </div>
            </div>

            <div class="mb-3">
                <label for="inputTitle" class="col-sm-3 col-form-label">ShortTitle</label>
                <div class="col-8">
                    <input type="text"
                           class="form-control"
                           id="inputTitle"
                           name="short_title"
                           value="{{old('short_title',$slider->short_title)}}">
                    @error('short_title')
                    <p class="text-danger">{{$message}}</p>
                    @enderror

                </div>
            </div>
            <div class="mb-3">
                <label for="inputPicture" class="col-sm-3 col-form-label">Picture</label>
                <div class="col-8">
                    <input type="file"
                           class="form-control"
                           id="inputPicture"
                           name="slider_image"
                           value="">
                    <img src="/storage/slider/{{$slider->slider_image}}" style="width: 100px;height: 100px">


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

