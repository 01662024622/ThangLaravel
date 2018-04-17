<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
    	$users=User::orderBy('id','DESC')->get();
    	$currentUser = Auth::user();
    	return view('admins.userTable',['users'=>$users,'currentUser'=>$currentUser]);
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
	public function store(Request $request) {
		if ($request->hasFile('image')) {
			# code...
		$request->validate([
			'name'		=> 'required',
			'email'		=> 'required',
			'phone'		=> 'required',
			'address'	=> 'required',
			'password'	=> 'required',
            'image'		=> 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);
        $imageName= 'http://localhost:8800/images/'.time().'.'.$request->image->getClientOriginalExtension();

        $request->image->move(public_path('images'), $imageName);
		}else{
			$request->validate([
			'name'		=> 'required',
			'email'		=> 'required',
			'phone'		=> 'required',
			'address'	=> 'required',
			'password'	=> 'required',

        ]);
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
	public function updateUser(Request $request) {
		$request->validate([
			'id'		=> 'required',
			'name'		=> 'required',
			'email'		=> 'required',
			'phone'		=> 'required',
			'address'	=> 'required',
			'image'		=> 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);
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
