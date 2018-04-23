<?php

namespace App\Http\Controllers;
use App\Comment;
use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Category;
use Illuminate\Support\Facades\Auth;
use Session;


class FontController extends Controller
{
    public function index(){
        // header and footer
        
        $categories=Category::all();
        $subCategories=Category::all();
        $users=User::paginate(6);

        // body
        $posts=Post::where('status',1)->orderBy('id', 'desc')->get();
        foreach ($posts as $key => $value) {
        $data=User::where('id',$value->user_id)->get()->first();
            
            if (!empty($data)) {
                
                 $value['user_id']=$data->name;
                
             }else {$value['user_id']="Admin";
            }
        }

        $newPosts=Post::where('status',1)->orderBy('id', 'desc')->paginate(5);
        foreach ($newPosts as $key => $value) {
        $data=User::where('id',$value->user_id)->get()->first();
            
            if (!empty($data)) {
                
                 $value['user_id']=$data->name;
                
             }else {$value['user_id']="Admin";
            }
        }

        return view('font_end/index',['posts'=>$posts,'newPosts'=>$newPosts,'users'=>$users,'categories'=>$categories,'subCategories'=>$subCategories]);
    }
    public function post($slug){
       // header and footer
        session()->regenerate();
        Session::put('slug', $slug);
        $categories=Category::all();
        $subCategories=Category::all();

        $users=User::paginate(6);
        // body

        $newPosts=Post::where('status',1)->orderBy('id', 'desc')->paginate(5);
        foreach ($newPosts as $key => $value) {
        $data=User::where('id',$value->user_id)->get()->first();
            
            if (!empty($data)) {
                
                 $value['user_id']=$data->name;
                
             }else {$value['user_id']="Admin";
            }
        }
        $post=Post::where('slug',$slug)->first();
        $data=User::where('id',$post->user_id)->first();
            // dd(isset($data));
            if (isset($data)) {
                
                 $post['user_id']=$data->name;
                
             }else {$post['user_id']="Admin";
            
            }
        $comments=Comment::where('post_id',$post->id)->orderBy('updated_at','DESC')->get();
        foreach ($comments as $key => $value) {
            # code...
        $change=User::where('id',$value->user_id)->get()->first();
        if (!empty($change)) {
                
                 $value['user_id']=$change->name;
                 $value['avata']=$change->avata;
                
             }else {
                $value['user_id']="Admin";
                $value['avata']="http://localhost:8800/images/posts/userDefault.png";
            }
        }
        $subcomments=Comment::where('post_id',$post->id)->orderBy('updated_at','DESC')->get();
        foreach ($subcomments as $key => $value) {
            # code...
        $change=User::where('id',$value->user_id)->get()->first();
        if (!empty($change)) {
                
                 $value['user_id']=$change->name;
                 $value['avata']=$change->avata;
                
             }else {
                $value['user_id']="Admin";
                $value['avata']="http://localhost:8800/images/posts/userDefault.png";
            }
        }
        $userComment=Auth::user();
        // dd($userComment);
        return view('font_end/post',['post'=>$post,'comments'=>$comments,'subcomments'=>$subcomments,'newPosts'=>$newPosts,'users'=>$users,'categories'=>$categories,'subCategories'=>$subCategories,'userComment'=>$userComment]);
        }
         public function category($slug){
       // header and footer
      
        $categories=Category::all();
        $subCategories=Category::all();

        $users=User::paginate(5);
        // body

        $newPosts=Post::where('status',1)->orderBy('id', 'desc')->paginate(5);
        foreach ($newPosts as $key => $value) {
        $data=User::where('id',$value->user_id)->get()->first();
            
            if (!empty($data)) {
                
                 $value['user_id']=$data->name;
                
             }else {$value['user_id']="Admin";
            }
        }
        $main=Category::where('name',$slug)->first();
        $posts=Post::where('status',1)->where('category_id',$main->id)->get();
        // dd($main->id);
         foreach ($posts as $key => $post) {
        $data=User::where('id',$post->user_id)->get()->first();
            
            if (!empty($data)) {
                
                 $post['user_id']=$data->name;
                
             }else {$post['user_id']="Admin";
            
            }
        }
        return view('font_end/category',['posts'=>$posts,'main'=>$main,'newPosts'=>$newPosts,'users'=>$users,'categories'=>$categories,'subCategories'=>$subCategories]);
        }
    public function test(){
        $ad=Post::all();
        foreach ($ad as $key => $value) {
         $value['slug']=str_slug($value->title, '-');
         $id=$value->id;
          $ap=$value->only(['slug']);
         Post::where('id',$id)->update($ap);
        }
    }
    public function storeComment(){

    }
}
