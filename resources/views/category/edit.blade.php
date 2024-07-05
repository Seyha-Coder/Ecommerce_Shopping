@extends('admin.layout')
@section('content')
<main class="container d-flex justify-content-center  align-items-center ">
   
    <div class="container-fluid">
		<h1 class="mt-4">Edit Category ({{$categories->name}})</h1>
		<ol class="breadcrumb mb-4">
			<li class="breadcrumb-item"><a href="/category">View All Category</a></li>
			<li class="breadcrumb-item active"><a href="{{url('category/create')}}">Create category</a></li>
		</ol>
		<div>
            @if(Session::has('category_update'))
                <p class="text-success">{{session('category_update')}}</p>
            @endif

            {{ Form::model($categories , array('route' => array('category.update', $categories->id), 'method'=>'PUT')) }}
           	{{Form::label('name', 'Name:')}}
           	{{Form::text('name',null, array('class'=>'form-control'))}}
            <span class="text-danger">{{ $errors->first('name') }}</span><br>
            {{Form::label('description', 'Description:')}}
           	{{Form::text('description',null, array('class'=>'form-control'))}}
            <span class="text-danger">{{ $errors->first('description') }}</span><br>

           	{{Form::submit('Update', array('class'=>'btn btn-success'))}}
           	{{Form::close()}}
		</div>
		
	</div>
        
    
</main>
@endsection