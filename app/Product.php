<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    
    	protected $fillable = ['name','catalog_id','price','price','content','discount','image_link','image_list','view'];
    	public static function storeData($data){
    		return Product::create($data);

    	}
    	public static function updateData($data,$id){
    		$product=Product::find($id)->first();
    		$product=$product->update($data);
    		return $product;
    	}
    
}
