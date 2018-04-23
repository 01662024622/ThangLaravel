<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use App\User;
use Hash;
use Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
     public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }
    public function handleProviderCallback()
    {
        $user = Socialite::driver('google')->stateless()->user();


        
        $data['email']=$user->email;
        $user=User::where('email',$data['email'])->first();
        if (!isset($user)) {
            $data['password']=Hash::make($user->id);
            $data['avata']=$user->avatar;
            $data['name']=$user->getName();
            $data['address']='user comment form email';
            $user=User::create($data);
        }
        $id=$user->id;
         Auth::loginUsingId($id);
        $url = 'poster/'.session('slug');
        return redirect($url);     
    }
}
