@extends('admin.layouts.app')

@section('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" crossorigin="anonymous">
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h1 class="bd-title text-center">Products</h1>
        </div>
        <div class="col-md-12">
		    @if(session('success'))
				<div class="alert alert-success alert-dismissible" role="alert">
					{{session('success')}}
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    	    	<span aria-hidden="true">&times;</span>
		    	  	</button>
				</div>
			@endif
        </div>
        <div class="col-md-12">
        	<a href="{{url('admin/products/create')}}" class="btn btn-success">+ Add</a>
        </div>
        <div class="col-md-12">
        	<div class="table-responsive">
        		<table class="table table-striped" id="productsTable">
        		  <thead class="thead-dark|thead-light">
        		    <tr>
        		      <th scope="col">#</th>
        		      <th scope="col">Name</th>
        		      <th scope="col">Price (Rs.)</th>
        		      <th scope="col">Discount (%)</th>
        		      <th scope="col">Action</th>
        		    </tr>
        		  </thead>
        		  <tbody>
        		  	@foreach($products as $product)
	        		    <tr>
	        		      <th scope="row">{{$loop->index+1}}</th>
	        		      <td>{{$product->name}}</td>
	        		      <td>{{$product->price}}</td>
	        		      <td>{{$product->discount_percent}}</td>
	        		      <td>
	        		      	<a href="{{url('admin/products/'.$product->id.'/edit')}}" class="btn btn-primary">Edit</a>
	        		      	<a href="#" class="btn btn-info update-status" data-id="{{$product->id}}">{{$product->status=='active'?'Enable':'Disable'}}</a>
	        		      	<a href="#" class="btn btn-danger delete-product" data-id="{{$product->id}}">Delete</a>
	        		      </td>
	        		    </tr>
        		  	@endforeach
        		  </tbody>
        		</table>
        	</div>
        </div>
    </div>
</div>
<form action="{{url('admin/products')}}" id="deleteForm" method="POST">
	<input type="hidden" name="_method" value="delete">
	@csrf
</form>
<form action="{{url('products/update-status/')}}" id="updateStatus" method="POST">
	@csrf
</form>
@endsection

@section('scripts')
<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script>
	$(document).ready(function() {
		$("#productsTable").DataTable();
	});
	var deleteURL = "{{url('admin/products')}}";
	$(document).on('click', '.delete-product', function(event) {
		event.preventDefault();
		var productId = $(this).data('id');
		$("#deleteForm").attr('action', deleteURL+'/'+productId);
		$("#deleteForm").submit();
	});

	var updateStatusURL = "{{url('admin/products/update-status')}}";
	$(document).on('click', '.update-status', function(event) {
		event.preventDefault();
		var productId = $(this).data('id');
		$("#updateStatus").attr('action', updateStatusURL+'/'+productId);
		$("#updateStatus").submit();
	});
</script>
@endsection