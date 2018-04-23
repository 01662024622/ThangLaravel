<?php

namespace App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Post;
use App\Category;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class PostUserController extends Controller
{
    public function index(){
        $currentUser = Auth::user();
        $posts=Post::where('user_id',$currentUser->id)->orderBy('id','DESC')->get();
        $categories=Category::orderBy('id','DESC')->get();
        return view('users.postTable',['posts'=>$posts],['categories'=>$categories,'currentUser'=>$currentUser]);
    }
    public function postedPosts(){
        $currentUser = Auth::user();
        $posts=Post::where('user_id',$currentUser->id)->where('status','1')->orderBy('id','DESC')->get();
        $categories=Category::orderBy('id','DESC')->get();
        return view('users.postTable',['posts'=>$posts],['categories'=>$categories,'currentUser'=>$currentUser]);
    }
    public function browsingPosts(){
        $currentUser = Auth::user();
        $posts=Post::where('user_id',$currentUser->id)->where('status','0')->orderBy('id','DESC')->get();
        $categories=Category::orderBy('id','DESC')->get();
        return view('users.postTable',['posts'=>$posts],['categories'=>$categories,'currentUser'=>$currentUser]);
    }
    public function cancelledPosts(){
        $currentUser = Auth::user();
        $posts=Post::where('user_id',$currentUser->id)->where('status','2')->orderBy('id','DESC')->get();
        $categories=Category::orderBy('id','DESC')->get();
        return view('users.postTable',['posts'=>$posts],['categories'=>$categories,'currentUser'=>$currentUser]);
    }
    public function getData($id){
        $posts=Post::find($id)  ;
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
        $post= Post::create($data);
        return $post;
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
            $post=Post::find($id)->first();
            $post['created_up']= $post['created_up'];
            return $post;
        }else{
            return response()->json(['error'=>'500']);
        }
    }
    public function getReason($id){
        $post=Post::where('id',$id)->first();
        return $post;
    }
}
