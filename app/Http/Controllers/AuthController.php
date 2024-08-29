<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use User;
use Auth;
//return type redirectView
use Illuminate\View\View;
use Illuminate\Support\Facades\Mail;
//return type redirectResponse
use App\Mail\WelcomeEmail;
use Illuminate\Http\RedirectResponse;
use Hash;
use Str;
use Session;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    function getLogin() : View {
        return view('auths.login');
    }
    function postLogin(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/s'
        ]);
    
        if(Auth::attempt($request->only('email','password'))){
            if(Auth::user()->role == 'customer'){
                return redirect()->route('home');
            }else{
                return redirect()->route('dashboard-admin');
            }
        }else{
            return redirect()->route('login')->with('error', 'Invalid email or password. Please try again.');
        }
    }    
    
    public function getRegister() : View
    {
        return view('auths.register');
    }
    public function postRegister(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/s'
         ]);
        $user = new \App\Models\User;
        $user->role = 'customer';
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->remember_token = Str::random(60);
        $user->save();
        
        // Authentikasi pengguna baru
        Auth::login($user);
        
        Mail::to($user->email)->send(new WelcomeEmail());
        
        // Setelah autentikasi, Anda dapat melakukan redirect ke halaman yang sesuai
        return redirect()->route('login')->with('success', 'Registration successful. Please Login!.');
    }
    public function logout()
    {
        // Lakukan logout
        Auth::logout();
        Session::flush(); // Menghapus semua data sesi
        return redirect()->route('login');
    }
    
}