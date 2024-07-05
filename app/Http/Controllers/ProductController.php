<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
// use Spatie\Backtrace\File;
use Illuminate\Support\Facades\Auth;
use File;
use Illuminate\Support\Facades\Storage;



class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::check()){ //check user has login or not
            $products =Product::all();
            return view('product.index')->with('products',$products);
           
        }
        return redirect("login")->withErrors('You do not have access!'); //false go to login again
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories= array();
        foreach(Category::all() as $category){
            $categories[$category->id]=$category->name;
        }
        return view('product.create')->with('categories',$categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validate with inputation
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:20|min:3',
            'category_id' => 'required|integer',
            'price' => 'required|max:20|min:3',
            'image' => 'required',
            'description' => 'required|max:1000|min:10',
        ]);
          
        if ($validator->fails()) {
            return redirect('product/create')
                ->withInput()
                ->withErrors($validator);
        }
    
        // Create The product
        $image = $request->file('image'); //object
        $upload = 'img/'; //upload image to public img
        $filename = time().$image->getClientOriginalName();
        move_uploaded_file($image->getPathName(), $upload. $filename); //move to upload file name
    
        $product = new Product(); //create object product from model
        $product->name=$request->Input('name');
        $product->description=$request->Input('description');
        $product->image=$filename;
        $product->price=$request->Input('price');
        $product->category_id=$request->Input('category_id');
        $product->save(); //insert into products value(...)
        
        //--same meaning as above
        // $product->name = $request->name;
	    // $product->category_id = $request->category_id;
        // $product->price = $request->price;
        // $product->image = $filename;
        // $product->description = $request->description;
        // $product->save();
        Session::flash('product_create','New data is created.');
        return redirect('product/create');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::findOrFail($id);
        return view('product.show')->with('product', $product);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categories=array();
        foreach(Category::all() as $category){
            $categories[$category->id]=$category->name;
        }
        $product = Product::findOrFail($id);
        return view('product.edit')->with('product',$product)->with('categories',$categories);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator =Validator::make($request->all(), [
			'name' => 'required|max:20|min:3',
			'price' => 'required|max:20|min:3',
			'image' => 'mimes:jpg,jpeg,png,gif',
			'description' => 'required|max:1000|min:10',
		]);
        if ($validator->fails()) {
			return redirect('product/'.$id.'/edit')
				->withInput()
				->withErrors($validator);
		}
        $product = Product::find($id);
		// Create The Post
		if($request->file('image') != ""){
            $image = $request->file('image');
            $upload = 'img/';
            $filename = time().$image->getClientOriginalName();
	        move_uploaded_file($image->getPathName(), $upload. $filename); //move to upload file name
		}
		
		$product->name = $request->Input('name');
		$product->price = $request->Input('price');
		if(isset($filename)){
		    $product->image = $filename;
		}
        
		$product->description = $request->Input('description');
		$product->save();

		Session::flash('product_update','Data is updated');
		return redirect('product/'.$product->id.'/edit');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
    	$image_path = 'img/'.$product->image;
    	File::delete($image_path); //remove image from public/img/image_path
    	$product->delete(); //delete from table where PK=id
    	Session::flash('product_delete','Data is deleted.');
    	return redirect('product');
    }
}
