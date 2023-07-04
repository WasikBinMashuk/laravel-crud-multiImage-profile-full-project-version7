<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }
    
    public function profile(){
        return view('admin.profile.index');
    }

    public function update(Request $request){
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            
        ]);

        $id = Auth::user()->id;

        User::find($id)->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);



        return Redirect()->back()->with('success','Profile Updated');
    }

    public function password(){

        return view('admin.profile.password');
    }

    public function UpdatePassword(Request $request){

        $id = Auth::user()->id;
        $db_password = Auth::user()->password;
        $old_password = $request->old_password;
        $new_password = $request->new_password;
        $confirm_password = $request->confirm_password;

        //hash::check (ourValue, DB_value)

        if (Hash::check($old_password, $db_password)) {
            if ($new_password === $confirm_password) {
                User::find($id)->update([
                    'password' => Hash::make($request->new_password)
                ]);
                Auth::logout();
                return Redirect()->route('login')->with('success','Password Changed');
            } else {
                return Redirect()->back()->with('newError','Confirm new Password');
            }
            
        }else{
            return Redirect()->back()->with('error','Password does not matched');
        }

        return view('admin.profile.password');
    }
}
