<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Carbon\Carbon;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $count = User::all();
        $users = User::orderBy('id', 'desc')->paginate(5);
        return view('home',compact('users','count'));
    }
    public function update()
    {
        $id = Auth::user()->id;
        $user= User::find($id);
        return view('user.updateUser',compact('user'));
    }
    public function updateProfile(Request $request)
    {
        $request->validate([
            'user_name' => ['required','max:255'],
            'user_email' => ['required','email'],
        ],[
            'user_name.required' =>"Field Must not be empty",
            'user_email.required' =>"Field Must not be empty",
            'user_email.email' =>"Please Enter a valid Email",
        ]);
        $id = Auth::user()->id;
        $update =User::findorFail($id)->update([
            'name' => $request->user_name,
            'email' => $request->user_email,
            'updated_at' => Carbon::now()
        ]);
        if($update){
            return Redirect::back()->with('update', 'Updated Profile!');
        }

    }
    public function changePass_UI()
    {
        return view('user.changePassword');
    }
    public function changePass(Request $request)
    {
        $request->validate([
            'old_pass' => ['required'],
            'new_pass' => ['required'],
            'confirm_pass' => ['required'],
        ],[
            'old_pass.required' =>"Field Must not be empty",
            'new_pass.required' =>"Field Must not be empty",
            'confirm_pass.required' =>"Field Must not be empty",
        ]);

        $db_pass = Auth::user()->password;
        $old_pass = $request->old_pass;
        $new_pass = $request->new_pass;
        $confirm_pass = $request->confirm_pass;
        if(Hash::check($old_pass,$db_pass)){
            if($new_pass === $confirm_pass){
                $id = Auth::user()->id;
                $update = User::find($id)->update([
                    'password'=>Hash::make($new_pass),
                    'updated_at' => Carbon::now()
                ]);
                if($update)
                {
                    Auth::logout();
                    return Redirect()->route('login')->with('PasswordChange', 'Password has Changed! You have to login now!!');
                }
            }else{
                return Redirect::back()->with('errorpass', 'Password Doesnt match!');
            }
        }else{
            return Redirect::back()->with('error', 'Old Password Doesnt match!');
        }
    }
}
