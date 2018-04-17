<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
     public function index(){
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
    	return view('admins.categoryTable',['categories'=>$categories,'currentUser'=>$currentUser]);
	}


	
	public function getData($id){
    	$categorys=Category::find($id);
    	return response()->json($categorys);
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



	public function store(Request $request) {
		$request->validate([
			'name'		=> 'required',
			'parent_id'		=> 'required',
			'sort_order'		=> 'required',
        ]);
		$categories= Category::create($request->only(['name','parent_id','sort_order']));
		$pid=$categories->parent_id;
		if ($pid=='0') {
    			$value['parent_id']="Main Category";
    		}else{
	    		$pid=Category::where('id',$pid)->first();
	    		$categories['parent_id']=$pid->name;
    		}
		return $categories;
	}



	public function updateProduct(Request $request) {
		$request->validate([

			'id'		=> 'required',
			'name'		=> 'required',
			'parent_id'		=> 'required',
			'sort_order'		=> 'required',
        ]);
		$id=$request->only(['id']);
		$data=$request->only(['name','parent_id','sort_order']);
		$categories=Category::find($id)->first()->update($data);
		if ($categories) {
			$data=Category::find($id)->first();
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
