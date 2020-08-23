@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h1 class="bd-title text-center">Products</h1>
        </div>
        <div class="col-md-12">
            <label>Per Page</label>
            <select class="col-md-1 custom-select per_page_select">
              <option value="5" {{Request::get('per_page')==5?'selected':''}}>5</option>
              <option value="10" {{Request::get('per_page')==10?'selected':''}}>10</option>
              <option value="15" {{Request::get('per_page')==15?'selected':''}}>15</option>
              <option value="20" {{Request::get('per_page')==20?'selected':''}}>20</option>
            </select>
        </div>
        <div class="col-md-12">
            <div class="row">
                @foreach($products as $product)
                    <div class="card col-md-2 m-3">
                      <img class="card-img-top" src="{{url('uploads/products/'.$product->display_image)}}" alt="{{$product->name}}">
                      <div class="card-body">
                        <h5 class="card-title">{{$product->name}}</h5>
                        <p class="card-text">{{  Str::limit($product->description, 50, '...') }}</p>
                        <p>
                            <span class="cost font-weight-bold">Rs.{{$product->price}}</span>
                            <span class="discount float-right">{{$product->discount_percent}} % Off</span>
                        </p>
                      </div>
                    </div>
                @endforeach
            </div>
        </div>
        {{ $products->withQueryString()->links() }}
    </div>
</div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $(".per_page_select").click(function(event) {
                var per_page = $(".per_page_select option:selected").val();
                window.location.href = "{{route('products')}}"+"?per_page="+per_page;
            });
        });
    </script>
@endsection
