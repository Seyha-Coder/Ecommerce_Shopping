<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;



class CategoryController extends Controller
{
    /** 
    * @return \Illuminate\Http\Response
    */
    public function index(){
        //select all data from model
        $categories=Category::all();
        //return data to view
        return view('category.index')->with('categories',$categories);
    }
    /** 
    * @return \Illuminate\Http\Response
    */
    public function create (){

        //
        return view('category.create');

    }
    /** 
    * @param \Illuminate\Http\Request $request
    * @return \Illuminate\Http\Response
    
    */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:255',
        ]);
        //if the validation does not match, it will return errors object

        // Create a new object from model
        $category = new Category;
        $category->name = $request->name;
        $category->description = $request->description;
        $category->save(); //insert data to the database

        Session::flash('category_created','New category has been created successfully');
        return redirect('category/create');
    }

    /** 
    * @return \Illuminate\Http\Response
    */
    public function edit($id){
        //find category id
        $category=Category::find($id); //find by primary key
        if($category !=null){
            return view('category.edit')->with('categories',$category);
        }else{
            Session::flash('category_not_exist','This category with id '.$id.'is not existed in th database');
            return redirect('/category');
        }
        
    }
    /** 
    * @param \Illuminate\Http\Request $request
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
			'name' => 'required|max:20|min:3',
            'description' => 'required|max:20|min:3',
		]);
		if ($validator->fails()) {
			return redirect('/category/' . $id . '/edit')
            ->withInput()
            ->withErrors($validator);
		}
		// Create The Category
		$category = Category::find($id);
		$category->name = $request->Input('name');
        $category->description = $request->Input('description');
		$category->save();
		Session::flash('category_update','Category '.$request->name.' has been updated successfuly');
		return redirect('/category/' . $id . '/edit');
    }
    /** 
    * @param \Illuminate\Http\Request $request
    * @return \Illuminate\Http\Response
    */
    public function show($id){
        $category=Category::find($id);
        if($category != null){
            return view('category.show')->with("category",$category);
        }else{
            Session::flash('category_show',' not found '.$id.' in the category ');
		    return redirect('/category');
        }
    }
    /** 
    * @return \Illuminate\Http\Response
    */
    public function destroy($id){
        $category = Category::find($id);
    	$category->delete();
    	Session::flash('category_delete','Category is deleted');
    	return redirect('/category');
    }
}
