<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Tag;
use Illuminate\Support\Facades\Auth;
class TagController extends Controller
{
     public function index(){
    	$tags=Tag::orderBy('id','DESC')->get();
    	// dd($tags);
    	$currentUser = Auth::user();
    	return view('admins.tagTable',['tags'=>$tags,'currentUser'=>$currentUser]);
	}
	public function getData($id){
    	$tags=Tag::find($id);
    	return $tags;
	}
	public function delete($id){
		// Product::find($id);

		$data=Tag::find($id)->delete();
		return response()->json($data);
	}
	public function store(Request $request) {
		$data=$request['name'];
    	$tags=Tag::createTags($data);
    	return $tags;
	}
	public function updateTag(Request $request) {
		$id=$request->only(['id']);
		$data=$request->only(['name']);
        $data['slug']=str_slug($data['name']);
        $check=Tag::where('slug',$data['slug']);
        if (isset($check)){
        	return $data;
        }else{
        	$tag=Tag::find($id)->first()->update($data);
        	if ($tag) {
				$data=Tag::find($id)->first();
			# code...
			}
		}	
		
		
		return $data;	
	}
}
