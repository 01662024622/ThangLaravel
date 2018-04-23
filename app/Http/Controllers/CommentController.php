<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Comment;

use App\Post;
use Auth;
class CommentController extends Controller
{
    public function createComment(Request $request){
        $data=$request->only(['content','parent_id','post_id']);
        return $data;
        $user=Auth::user();
        $data['user_id']=$user->id;
        $comment=Comment::create($data);
        $user['content']=$comment['content'];
        $user['parent_id']=$comment['parent_id'];
        $user['post_id']=$comment['post_id'];
    	return $user;
    }
    public function updateComment(Request $request){
    	$data=$request->only(['content','parent_id','post_id']);
    	$id=$request->only(['id']);
    	$comment=Comment::find($id)->get()->first()->update($data);
    	return $comment;
    }
    public function deleteComment(Request $request){
    	$id=$request->only(['id']);
    	$comment=Comment::find($id)->delete();
    	return json_encode($comment);
    }
}
