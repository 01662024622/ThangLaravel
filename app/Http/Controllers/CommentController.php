<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Comment;

use App\Post;
class CommentController extends Controller
{
    public function createComment(Request $request){
        return $request;
    	$data=$request->only(['content','parent_id','post_id']);
    	$comment=Comment::create($data);
    	return $comment;
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
