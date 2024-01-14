<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    //show register/create form

    public function create(){
        return view('users.register');
    }
    public function store(Request $request){
     $formFields=  $request->validate([
        'name' =>['required','min:3'],
        'email' =>['required','email',Rule::unique('users','email')],
        'password' =>['required','confirmed','min:6'],
     ]);
     //hash password

     $formFields['password']=bcrypt($formFields['password']);
     
     $user=User::create($formFields);

     auth()->login($user);
     return redirect('/')->with('Message','User created and logged in');
    }

    //loogut user
    public function logout(Request $request){
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('Message','Logged Out');
    }
    //shpw login form 
    public function login(){
       return view('users.login');
    }

    public function authenticate(Request $request){
        $formFields=  $request->validate([
            'email' =>['required','email'],
            'password' =>['required']
         ]);
         if(auth()->attempt($formFields)){
            $request->session()->regenerate();
            return redirect('/')->with('Message','Logged You are now logged in!');

         }
         return back()->withErrors(['email'=>'Invalid Credentials'])->onlyInput('email');
    }
}
