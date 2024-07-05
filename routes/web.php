<?php
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\UpdateProfileController;
use App\Http\Controllers\FrontEndController;
use App\Models\Category;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/category',function(){
//     $categories=Category::all();
//     //dd($categories); //dd=debug or die();
//     foreach($categories as $category){
//         echo $category->name." ".$category->description."<br>";
//     }
// });
// Route::view('/admin','admin.main');

// Route::get('/', [AuthController::class, 'index'])->name('login');
// Route::get('/', [ProductController::class, 'index'])->name('product.list');

//emplement category features and  routes
Route::get('/category',[CategoryController::class,'index'])->name("category.list");

Route::get('/category/create', [CategoryController::class, 'create'])->name("category.create");
//route to submit data
Route::post('/category', [CategoryController::class, 'store'])->name("category.store");

Route::get('/category/{categoryId}/edit',[CategoryController::class, 'edit'])->name("category.edit");

//update one record in the database
Route::put('/category/{categoryId}', [CategoryController::class, 'update'])->name('category.update');
//show category
Route::get('/category/{categoryId}',[CategoryController::class, 'show'])->name('category.show');
//delete one record in the database
Route::delete("/category/{categoryId}",[CategoryController::class, 'destroy'])->name('category.delete');
//end category route

//emplement product features and routes
Route::get('/product', [ProductController::class, 'index'])->name('product.list');
//create product
Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
Route::post('/product',[ProductController::class, 'store'])->name('product.store');


Route::get('/product/{product}/edit',[ProductController::class,'edit'])->name('product.edit');
//update one product record in the database
Route::put('/product/{product}',[ProductController::class,'update'])->name('product.update');
//show product detail
Route::get('/product/{product}',[ProductController::class,'show'])->name('product.show');
//delete product
Route::delete('/product/{product}',[ProductController::class, 'destroy'])->name('product.destroy');

// authentication features  login and register , lohout , dashboard
Route::get('/registration', [AuthController::class, 'registration'])->name('register');
Route::post('/post-registration', [AuthController::class, 'postRegistration'])->name('register.post'); //when submit from registration.blade.php , it come here

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/post-login', [AuthController::class, 'postLogin'])->name('login.post'); //work when submit from login.blade.php

// Route::get('/dashboard', [AuthController::class, 'dashboard']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// change password
Route::get('/change-password', [ChangePasswordController::class, 'index'])->name('form.password');
Route::post('/change-password', [ChangePasswordController::class, 'store'])->name('change.password');

// update profile
Route::get('/update-profile/{user}',  [UpdateProfileController::class, 'editProfile'])->name('profile.edit');
Route::patch('/update-profile/{user}',  [UpdateProfileController::class, 'updateProfile'])->name('profile.update');

//verify
Route::get('/dashboard', [AuthController::class, 'dashboard'])->middleware(['auth' => 'is_verify_email']); 
Route::get('/account/verify/{token}', [AuthController::class, 'verifyAccount'])->name('user.verify'); 

Route::get('/',[FrontEndController::class, 'index'])->name('frontend.index');
Route::get('/show/{productId}',[FrontEndController::class, 'show'])->name('frontend.show'); 
Route::get('/search', [FrontEndController::class, 'getBySearch'])->name('frontend.search');

