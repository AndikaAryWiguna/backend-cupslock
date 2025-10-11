<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Login Controller
    public function login()
    {
        return view('authentification.login', [
            'title' => 'Login'
        ]);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required',
        ]);
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
 
            return redirect()->intended('/admin');
        }
 
        return back()->with('loginError', 'Login Failed, Try Again or Register!');
    }
    
    public function logout(Request $request){

        Auth::logout();
     
        $request->session()->invalidate();
     
        $request->session()->regenerateToken();
     
        return redirect('/');
    }


    // Register Controller
    public function register()
    {
        return view('authentification.register', [
            'title' => 'Register'
        ]);
    }

    public function store(Request $request)
    {
       $validateData = $request -> validate([
        'name' => 'required|max:255',
        // bisa menggunakan array juga seperti dibawah ini
        'username' => ['required','min:1','max:20','unique:users'],
        'email' => 'required|email:dns|unique:users',
        'password' => 'required|min:5|max:10'
       ]);

        // Untuk encript password
        // $validateData['password'] = bcrypt($validateData['password']);
        // atau menggunakan Hashing
        // $validateData['password'] = Hash::make($validateData['password']);

       User::create($validateData);

    //    $request->session()->flash('success', 'Registration was successful! Please login');
       
       return redirect('/login')->with('success', 'Registration was successful! Please login');
    }
}
