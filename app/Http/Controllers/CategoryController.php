<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use App\Category;
use App\Post;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
     public function index(){
     	$noticePost=Post::where('status','0')->get();
        $sumPost=0;
        foreach ($noticePost as $key => $value) {
           $sumPost=$sumPost+1;
        }
        $sumNotice=0;
        foreach ($noticePost as $key => $value) {
           $sumNotice=$sumNotice+1;
        }
    	$categories=Category::orderBy('id','DESC')->get();
    	$currentUser = Auth::user();
    	foreach ($categories as $key => $value) {
    		$pid=$value->parent_id;
    		if ($pid=='0') {
    			$value['parent_id']="Main Category";
    		}else{
	    		$tagName=Category::where('id',$pid)->first();

	    		$value['parent_id']=$tagName['name'];
    		}
    	}
    	return view('admins.categoryTable',['categories'=>$categories,'currentUser'=>$currentUser,'noticePost'=>$noticePost,'sumNotice'=>$sumNotice,'sumPost'=>$sumPost]);
	}


	
	public function getData($id){
    	$categories=Category::find($id);
    	return $categories;
	}



	public function getProduct($id){
    	$categories=Category::find($id);
    	return $categories;
	}



	public function delete($id){
		// Product::find($id);

		$data=Category::find($id)->delete();
		return response()->json($data);
	}



	public function store(CategoryRequest $request) {
		$data=$request->only(['name','parent_id','sort_order']);
		$categories=Category::create($data);
		$pid=$categories->parent_id;
		if ($pid=='0') {
    			$categories['parent_id']="Main Category";
    		}else{
	    		$pid=Category::where('id',$pid)->first();
	    		$categories['parent_id']=$pid->name;
    		}
		return $categories;
	}



	public function updateProduct(CategoryRequest $request) {
		$id=$request->only(['id']);
		$data=$request->only(['name','parent_id','sort_order']);
		$categories=Category::find($id)->first()->update($data);
		if ($categories) {
			$data=Category::where('id',$id)->first();
			$pid=$data->parent_id;
			if ($pid=='0') {
    			$data['parent_id']="Main Category";
    		}else{
	    		$pid=Category::where('id',$pid)->first();
	    		$data['parent_id']=$pid->name;
    		}
    		return $data;
		};
		 return response()->json(['error'=>'500']);	
	}
}
