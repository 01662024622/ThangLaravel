<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable=['content','parent_id','sort_order',];
    
    	public static function updateData($data,$id){
    		$category=Category::find($id)->first();
    		$category=$category->update($data);
    		return $post;
    	}
}
