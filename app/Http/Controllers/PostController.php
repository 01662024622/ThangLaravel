<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Post;
use App\Category;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index(){
    	$posts=Post::orderBy('id','DESC')->get();
    	$categories=Category::orderBy('id','DESC')->get();
    	$currentUser = Auth::user();
    	return view('admins.postTable',['posts'=>$posts],['categories'=>$categories,'currentUser'=>$currentUser]);
	}
	public function getData($id){
    	$posts=Post::find($id)	;
    	// $categories=Category::orderBy('id','DESC')->get();
    	return response()->json($posts);
	}
	public function delete($id){
		// Product::find($id);

		$data=Post::find($id)->delete();
		return response()->json($data);
	}
	
	public function store(PostRequest $request) {
		if ($request->hasFile('image')) {
        $imageName= 'http://localhost:8800/images/posts/'.time().'.'.$request->image->getClientOriginalExtension();
        
        $request->image->move(public_path('images/posts'), $imageName);
		}else{
			$imageName='http://localhost:8800/images/posts/userDefault.png';
		}
        
        $data=$request->all();
        $data['user_id'] = Auth::user()->id;
        unset($data['image']);
        unset($data['tags']);
        $data['image']=$imageName;
		$user= Post::create($data);
		 return $user;
		// return redirect()->back();
	
	}
	public function updatePost(PostRequest $request) {
        $data=$request->all();
		if ($request->hasFile('editImage')) {
		$request->validate([
			'title'			=> 'required',
			'description'	=> 'required',
			'content'		=> 'required',
			'category_id'	=> 'required',
			'tags'			=> 'required',
            'editImage'			=> 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);
        $imageName= 'http://localhost:8800/images/posts/'.time().'.'.$request->editImage->getClientOriginalExtension();

        $request->editImage->move(public_path('images/posts'), $imageName);
        $data['image']=$imageName;
		}
        unset($data['editImage']);
        unset($data['tags']);
        unset($data['id']);
        $id=$request->only(['id']);
        $boolean=Post::find($id)->first()->update($data);
        if ($boolean) {
		return Post::find($id)->first();
        }else{
        	return response()->json(['error'=>'500']);
        }
    }
}
