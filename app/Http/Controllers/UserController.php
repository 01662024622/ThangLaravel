<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\UserRequest;

use App\Http\Requests\UserUpdateRequest;

use App\User;
use App\Post;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;

class UserController extends Controller
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
    	$users=User::orderBy('id','DESC')->get();
    	$currentUser = Auth::user();
    	return view('admins.userTable',['users'=>$users,'currentUser'=>$currentUser,'noticePost'=>$noticePost,'sumNotice'=>$sumNotice,'sumPost'=>$sumPost]);
	}
	public function getData($id){
    	$users=User::find($id);
    	// $categories=Category::orderBy('id','DESC')->get();
    	return $users;
	}
	
	public function delete($id){
		// Product::find($id);
		// $data=User::find($id);
		$data=User::find($id)->delete();
		return response()->json($data);
	}
	public function store(UserRequest $request) {
		if ($request->hasFile('image')) {
        $imageName= 'http://localhost:8800/images/'.time().'.'.$request->image->getClientOriginalExtension();

        $request->image->move(public_path('images'), $imageName);
		}else{
			$imageName='http://localhost:8800/images/userDefault.png';
		}
        
        $data=$request->all();
        $data['avata']=$imageName;
        $data['password']=Hash::make($data['password']);
        unset($data['image']);
		$user= User::create($data);
		 return $user;
		// return redirect()->back();
	}
	public function updateUser(UserUpdateRequest $request) {
        $data=$request->all();
        unset($data['image']);
        unset($data['id']);
		if ($request->hasFile('image')) {
        $imageName= 'http://localhost:8800/images/'.time().'.'.$request->image->getClientOriginalExtension();

        $request->image->move(public_path('images'), $imageName);
        $data['avata']=$imageName;
		}
        
        $id=$request->only(['id']);
        $boolean=User::find($id)->first()->update($data);
        if ($boolean) {
		return User::find($id)->first();
        }else{
        	return response()->json(['error'=>'500']);
        }
    }
}
