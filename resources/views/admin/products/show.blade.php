<x-admin.layouts.admin_master>


    <div class="col-12 col-lg-12 col-xxl-9 d-flex">
        <div class="card flex-fill">
            <div class="card-header">

                show Brand <a class="btn btn-info" href="{{route('products.index')}}">List</a>
            </div>

            <h2> Title:{{$product->slider_title}}</h2>
            <h2> <img src="{{asset("$product->slider_image")}}" width="200px" height="300"></h2>


        </div>
    </div>


</x-admin.layouts.admin_master>


