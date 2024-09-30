<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class UserController extends Controller
{
    public function register(Request $request)
{
    echo($request);
    $validated = $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => [
            'required',
            'string',
            'min:8',   
            'regex:/[A-Z]/',      
            'regex:/[0-9]/',     
            'regex:/[@$!%*#?&]/'
        ],
        'password_confirmation' => 'required|same:password|min:8'
        
    ]);
    
    User::create($request->all());

    return back()->with('status', 'successfully inserted');
}
public function signin(Request $request){

    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::attempt([
        'email' => $request->email,
        'password' => $request->password,
    ])) {
        return redirect()->intended('home');
    }else{
        return redirect("login")->withError('Oppes! You have entered invalid credentials');
    }
}
public function logout(): RedirectResponse
    {
        Session::flush();
        Auth::logout();
  
        return Redirect('login');
    }
}
