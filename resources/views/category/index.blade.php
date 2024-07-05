
 
<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container bg-primary text-warning">
        <h1>Category List</h1>
        
            <?php

            //    if(count($categories)>0){
            //         echo "<table class='table table-striped table-hover table-border'>
            //         <thead class=' bg-primary'>
            //         <th>Name</th>
            //         <th>Description</th>
            //         </thead>
            //     <tbody>";
            //         foreach($categories as $category){
            //             echo "<tr>
            //                     <td>{$category->name}</td>
            //                     <td>{$category->description}</td>
            //                 </tr>";
            //         } 
                
            // echo " </tbody>
            //     </table>";
            //     } else{
            //         echo "There's no record";
            //     } 
                ?>
            @if(count($categories)>0)
                <table class="table table-striped table-hover table-border">
                    <thead class= "bg-primary">
                        <th>Name</th>
                        <th>description</th>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                        <tr>
                            <td>{{$category->name}}</td>
                            <td>{{$category->description}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
                
        
        
    </div>
    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quod sunt quos obcaecati earum?</p>
</body>
</html> -->
@extends('admin.layout')
@section('content')
    <main>
        <div class="container px-4">
            <div class="d-flex justify-content-between mt-4 mb-3 align-items-center">
                <h1 class="">Category List</h1>
                <a href="{{url('category/create')}}" class="btn btn-primary ">Create</a>
            </div>
            @if(Session::has('category_not_exist'))
            <p class="text-danger">{{ session('category_not_exist') }}</p>
            @endif

            <!-- session of show -->
            @if(Session::has('category_show'))
            <p class="text-danger">{{ session('category_show') }}</p>
            @endif
            <!-- session of delete -->
            @if(Session::has('category_delete'))
            <p>{!! session('category_delete') !!}</p>

            @endif
            @if(count($categories)>0)
                <table class="table table-striped table-hover table-border">
                    <thead class= "bg-primary">
                        <th>Name</th>
                        <th>description</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                        <tr>
                            <td>{{$category->name}}</td>
                            <td>{{$category->description}}</td>
                            <td class= "d-flex">
                                <a href="{{url('/category/'.$category->id.'/edit')}}" class="btn btn-primary " >Edit</a>
                                <a href="{{url('/category/'.$category->id)}}" class="btn btn-success mx-1" >View</a>
                                {{ Form::open(array('url'=>'category/'. $category->id, 'method'=>'DELETE')) }}
                                {{csrf_field()}}
                                {{method_field('DELETE')}}
                                    <button class="btn btn-danger delete">Delete</button>
                                {{ Form::close() }}
                                
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
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

