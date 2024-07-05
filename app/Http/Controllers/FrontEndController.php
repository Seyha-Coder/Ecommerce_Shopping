<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class FrontEndController extends Controller
{
    public function index()
    {
        //return view('frontend.index'); 
        //arsending order
    	return view('frontend.index')->with('products', Product::orderBy('created_at','ASC')->paginate(4)); 
        //desending order
        //return view('frontend.index')->with('products', Product::orderBy('created_at','DESC')->paginate(4));
    }
    public function show($id){
        $products = Product::all();
        $categories = Category::all();
        return view('frontend.show')->with('product',Product::find($id))->with('products', Product::orderBy('created_at','DESC')->paginate(4))->with('categories',$categories);
    }
    public function getBySearch(Request $request) {
        $keyword = !empty($request->input('keyword'))? $request->input('keyword'): "";
        if( $keyword != ""){
            return view('frontend.index')
                ->with('products', Product::where('name', 'LIKE', '%'.$keyword.'%')->paginate(4))
                ->with('keyword', $keyword); 
        } else {
            return view('frontend.index')
                ->with('products', Product::paginate(4))
                ->with('keyword', $keyword); 
        } 
    }

}
