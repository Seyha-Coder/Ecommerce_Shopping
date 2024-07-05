@extends('admin.layout')
@section('content')
<main class="container d-flex justify-content-center  align-items-center ">
   
    <div class="container-fluid">
		<h1 class="mt-4">View Category</h1>
		<div class="cart">
            <p>Category Name: {{$category->name}}</p>
            <p>Category Description: {{$category->description}}</p>
        </div>
		
		<a href="{{url('/category')}}" class="btn btn-warning">Back</a>
	</div>
        
    
</main>
@endsection