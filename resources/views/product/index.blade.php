@extends('admin.layout')
@section('content')

<main>
<div class="container px-4">
            <div class="d-flex justify-content-between mt-4 mb-3 align-items-center">
                <h1 class="">Product List</h1>
                <a href="{{url('product/create')}}" class="btn btn-primary ">Create</a>
            </div>
            @if(Session::has('product_not_exist'))
            <p class="text-danger">{{ session('product_not_exist') }}</p>
            @endif

            <!-- session of show -->
            @if(Session::has('category_product'))
            <p class="text-danger">{{ session('producct_show') }}</p>
            @endif
            <!-- session of delete -->
            @if(Session::has('product_delete'))
            <p>{!! session('product_delete') !!}</p>

            @endif
            @if(count($products)>0)
            <div class="panel panel-default">
                    <div class="panel-heading">
                        All Products
                    </div>

                    <div class="panel-body">
                        <table class="table table-striped task-table table-hover">
                            <thead>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Category</th>
                                <th>Image</th>
                                <th>Price</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                <tr>
                                    <td>
                                        <div>{{ $product->name }}</div>
                                    </td>
                                    <td>
                                        <div>{{$product->description}}</div>
                                    </td>
                                    <td>
                                        <div>{{$product->category->name}}</div>
                                    </td>
                                    <td>
                                        <div>{{ Html::image('img/'.$product->image, $product->name, array('width'=>'60'))}}</div>
                                    </td>
                                    <td>
                                        <div>{{$product->price}}</div>
                                    </td>

                                    <td class="d-flex h-auto align-items-center">
                                        <a class="btn btn-primary" href="{{ url('product/' . $product->id . '/edit') }}">Edit</a>
                                        <a class="btn btn-primary mx-1" href="{{ url('product/' . $product->id ) }}">view</a>

                                        {{ Form::open(array('url'=>'product/'. $product->id, 'method'=>'DELETE')) }}
                                        {{csrf_field()}}
                                        {{method_field('DELETE')}}
                                            <button class="btn btn-danger delete">Delete</button>
                                        {{ Form::close() }}
                                
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div>
                        <a href="{{url('/category')}}" class="btn btn-primary">View Category</a>
                        </div>
                    </div>
            @endif
            
        </div>
        <script>
            $(".delete").click(function() {
                var form = $(this).closest('form');
                $('<div></div>').appendTo('body')
                    .html('<div><h6 class="text-danger"> Are you sure to delete this category?</h6></div>')
                    .dialog({
                        modal: true,
                        title: 'Delete message',
                        zIndex: 10000,
                        autoOpen: true,
                        width: 'auto',
                        resizable: false,
                        buttons: {
                            Yes: function() {
                                $(this).dialog('close');
                                form.submit();
                            },
                            No: function() {

                                $(this).dialog("close");
                                return false;
                            }
                        },
                        close: function(event, ui) {
                            $(this).remove();
                        }
                    });
                return false;
            });
        </script>
</main>
@endsection