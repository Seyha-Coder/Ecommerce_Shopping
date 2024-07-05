<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Product extends Model
{
    use HasFactory;
    protected $table="products";
    protected $fillable =[
        'name',
        'description',
        'image',
        'price',
        'category_id'
    ];

    //function reeference to primary key of categories table
    public function category() {
        return $this->belongsTo(Category::class); //relationship 1:M
        //$this mean product     it mean that a product has its category
        //return objects of current category
    }
}
