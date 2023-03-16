<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;


class LoginController extends Controller
{
    public function index(){
        return view('login');
    }

    public function authenticate(Request $request){
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();

            $user = Auth::user();
            if($user->hasRole('admin')){
                Alert::success('Login success!', 'Selamat datang '.$user->nama_lengkap);
                return redirect()->intended('/dashboard/admin');
            } else if ($user->hasRole('guru')){
                Alert::success('Login success!', 'Selamat datang '.$user->nama_lengkap);
                return redirect()->intended('/dashboard/guru');
            } else if ($user->hasRole('user')){
                Alert::success('Login success!', 'Selamat datang '.$user->nama_lengkap);
                return redirect()->intended('/dashboard/user');
            }
        };
        if(!Auth::attempt($credentials)){
            Alert::error('Login failed!', 'Username or Password is wrong.');
            return back()->with('loginErrors', 'Login failed');
        }

        return back()->with('loginErrors', 'Login failed');
    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
