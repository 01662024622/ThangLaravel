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
        $noticePost=Post::where('status','0')->get();
        $sumPost=0;
        foreach ($noticePost as $key => $value) {
           $sumPost=$sumPost+1;
        }
        $sumNotice=0;
        foreach ($noticePost as $key => $value) {
           $sumNotice=$sumNotice+1;
        }
    	$posts=Post::orderBy('updated_at','DESC')->get();
    	$categories=Category::orderBy('id','DESC')->get();
    	$currentUser = Auth::user();
    	return view('admins.postTable',['posts'=>$posts,'categories'=>$categories,'currentUser'=>$currentUser,'noticePost'=>$noticePost,'sumNotice'=>$sumNotice,'sumPost'=>$sumPost]);
	}
    public function postedPosts(){
        $noticePost=Post::where('status','0')->get();
        $sumPost=0;
        foreach ($noticePost as $key => $value) {
           $sumPost=$sumPost+1;
        }
        $sumNotice=0;
        foreach ($noticePost as $key => $value) {
           $sumNotice=$sumNotice+1;
        }
        $currentUser = Auth::user();
        $posts=Post::where('user_id',$currentUser->id)->where('status','1')->orderBy('id','DESC')->get();
        $categories=Category::orderBy('id','DESC')->get();
        return view('admins.postTable',['posts'=>$posts],['categories'=>$categories,'currentUser'=>$currentUser,'noticePost'=>$noticePost,'sumNotice'=>$sumNotice,'sumPost'=>$sumPost]);
    }
    public function browsingPosts(){
        $noticePost=Post::where('status','0')->get();
        $sumPost=0;
        foreach ($noticePost as $key => $value) {
           $sumPost=$sumPost+1;
        }
        $sumNotice=0;
        foreach ($noticePost as $key => $value) {
           $sumNotice=$sumNotice+1;
        }
        $currentUser = Auth::user();
        $posts=Post::where('user_id',$currentUser->id)->where('status','0')->orderBy('id','DESC')->get();
        $categories=Category::orderBy('id','DESC')->get();
        return view('admins.postTable',['posts'=>$posts],['categories'=>$categories,'currentUser'=>$currentUser,'noticePost'=>$noticePost,'sumNotice'=>$sumNotice,'sumPost'=>$sumPost]);
    }
    public function cancelledPosts(){
        $noticePost=Post::where('status','0')->get();
        $sumPost=0;
        foreach ($noticePost as $key => $value) {
           $sumPost=$sumPost+1;
        }
        $sumNotice=0;
        foreach ($noticePost as $key => $value) {
           $sumNotice=$sumNotice+1;
        }
        $currentUser = Auth::user();
        $posts=Post::where('user_id',$currentUser->id)->where('status','2')->orderBy('id','DESC')->get();
        $categories=Category::orderBy('id','DESC')->get();
        return view('admins.postTable',['posts'=>$posts],['categories'=>$categories,'currentUser'=>$currentUser,'noticePost'=>$noticePost,'sumNotice'=>$sumNotice,'sumPost'=>$sumPost]);
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
        $data['slug']=str_slug($data['title']);
		$user= Post::create($data);
		 return $user;
		// return redirect()->back();
	
	}
	public function updatePost(PostRequest $request) {
        $data=$request->all();
		if ($request->hasFile('editImage')) {
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
    public function getReason($id){
        $post=Post::where('id',$id)->first();
        return $post;
    }
    public function changeStatus(Request $request){
        $id=$request->id;
        $data['status']=$request->status;
        if ($request->notice!=="") {
            $data['notice']=$request->notice;
        }
        $post=Post::find($id)->update($data);
        if ($post) {
            $post=Post::where('id',$id)->first();
        return $post;
            
        }
    }
}
