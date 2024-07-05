@extends('admin.layout')
@section('content')
<main>
	<div class="container-fluid">
		<h1>Show product</h1>
		<div class="card">
            <div class="card-body">
                <p>Name: {{$product->name}}</p>
                <p>Category: {{$product->category->name}}</p>
                <p>Price: {{$product->price}}</p>
                <p>Description: {{$product->description}}</p>
                <div>{!! Html::image('/img/'.$product->image, $product->name, array('width'=>'300')) !!}</div>
            </div>
		</div>
        <br>
        <a class="btn btn-secondary" href="{{url('/product')}}">Back</a>
	</div>
</main>
@endsection