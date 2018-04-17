<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{	public function index(){
    	$products=Product::orderBy('id','DESC')->get();
    	return view('products/index',['products'=>$products]);
	}
	public function getProduct($id){
    	$products=Product::find($id);
    	return $products;
	}
	public function delete($id){
		// Product::find($id);
		$data=Product::find($id)->delete();
		return response()->json($data);
	}
	public function store(Request $request) {
		
		$product= Product::storeData($request->only(['name','price','content','discount']));
		$product['created_at']=$product->created_at->diffForHumans();
		 return $product;
		// return redirect()->back();
	}
	public function updateProduct(Request $request) {
		$id=$request->only(['id']);
		$data=$request->only(['name','price','content','discount']);
		$product=Product::find($id)->first()->update($data);
		return $product;	
	}
	
}
