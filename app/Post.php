<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable=['title','description','content','image','status','category_id','user_id','slug',];
    public static function storeData($data){
    		return Post::create($data);

    	}
    	public static function updateData($data,$id){
    		$post=Post::find($id)->first();
    		$post=$product->update($data);
    		return $post;
    	}
}
