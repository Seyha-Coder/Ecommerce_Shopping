@extends('admin.layout')
@section('content')
<main class="container d-flex justify-content-center  align-items-center ">
    <div class="w-50 bg-secondary p-4 mt-5 rounded text-white">
        <h1 class=" mb-4">Category List</h1>
        <!-- @if(Session::has('category_created'))
                    <p class="text-success">{!! session('category_created') !!}</p>
        @endif
        {!! Form::open(['url' => 'category']) !!}

            {!! Form::label('name', 'Name: ') !!}
            {!! Form::text('name', '',array('class'=>'form-control')) !!}

            <span class="text-danger">{{ $errors->first('name') }}</span><br>
            {!! Form::label('description', 'Description: ') !!}
            {!! Form::text('description', '',array('class'=>'form-control')) !!}

            <span class="text-danger">{{ $errors->first('description') }}</span><br>
            {!! Form::submit('Create',array('class'=> 'btn-primary btn')) !!}
            <a href="{{url('/category')}}" class="btn btn-warning">Back</a>
        {!! Form::close() !!} -->
        @if(Session::has('category_created'))
            <p class="text-white">{{ session('category_created') }}</p>
        @endif
        {{ Form::open(['url' => 'category']) }}

            {{ Form::label('name', 'Name: ') }}
            {{ Form::text('name', '',array('class'=>'form-control')) }}

            <span class="text-danger">{{ $errors->first('name') }}</span><br>
            {{ Form::label('description', 'Description: ') }}
            {{ Form::text('description', '',array('class'=>'form-control')) }}

            <span class="text-danger">{{ $errors->first('description') }}</span><br>
            {{ Form::submit('Create',array('class'=> 'btn-primary btn')) }}
            <a href="{{url('/category')}}" class="btn btn-warning">Back</a>
            {{ Form::close() }}
    </div>
</main>
@endsection