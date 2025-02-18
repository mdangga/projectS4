<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    // Show sign up page
    function showSignup() {
        return view('signup');
    }

    // Handle sign up request
    function submitSignup(Request $request) {
        $user = new User();

        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->nama_user = $request->nama_user;
        $user->no_telpon = $request->no_telpon;
        $user->nama_perusahaan = $request->nama_perusahaan;
        $user->alamat = $request->alamat;
        $user->save();      

        return redirect()->route('signin.show')->with('success', 'Akun berhasil dibuat, silakan login!');
    }

    // Show admin dashboard
    function showAdmin() {
        return view('admin.dashboard');
    }

    // Show user dashboard
    function showUser() {
        return view('dasboard');
    }

    // Show sign in page
    public function showSignin() 
    {
        return view('signin');
    }
    
    // Handle sign in request
    public function submitSignin(Request $request) 
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Attempt to authenticate the user
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Redirect based on role
            $user = Auth::user();
            return match($user->role) {
                'admin' => redirect()->route('admin.show'),
                default => redirect()->route('user.show'),
            };
        }

        return redirect()->back()->with([
            'gagal' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    // Sign out method
    public function signOut(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('signin.show')
            ->with('logout', 'Anda telah berhasil logout.');
    }
}

// namespace App\Http\Controllers;

// use App\Models\User;
// // use Illuminate\Container\Attributes\Auth;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Http\Request;

// class authController extends Controller
// {
//     function showWelcome() {
//         return view('dasboard');
//     }
//     // function Sign Up(start)
//     function showSignup() {
//         return view('signup');
//     }
    
//     function submitSignup(Request $request) {
//         $user = new User();
    
        
//         $user->username = $request->username;
//         $user->email = $request->email;
//         $user->password = bcrypt($request->password);
//         $user->nama_user = $request->nama_user;
//         $user->no_telpon = $request->no_telpon;
//         $user->nama_perusahaan = $request->nama_perusahaan;
//         $user->alamat = $request->alamat;
//         $user->save();      

//         return redirect()->route('signin.show')->with('success', 'Akun berhasil dibuat, silakan login!');
//     }
//     // function Sign Up(end)

//     // function Sign In(start)
//     function showSignin() {
//         return view('signin');
//     }
    
//     function submitSignin(Request $request) {
//         $credentials = $request->validate([
//             'email' => ['required', 'email'],
//             'password' => ['required'],
//         ]);

//         if (Auth::attempt($credentials)) {
//             $request->session()->regenerate();

//             // Redirect berdasarkan role
//             $user = Auth::user();
//             if ($user->role === 'admin') {
//                 return redirect()->intended('/admin');
//             } else if ($user->role === 'manager') {
//                 return redirect()->intended('/dashboard');
//             }
            
//             // Default redirect untuk role lainnya
//             return redirect()->intended('/');
//         }

//         return back()->withErrors([
//             'email' => 'Email atau password salah.',
//         ])->onlyInput('email');

//     }
//     // function Sign Up(end)

//     //function Sign Out(start)
//     public function SignOut(Request $request)
//     {
//         Auth::logout();
//         $request->session()->invalidate();
//         $request->session()->regenerateToken();
//         return redirect('/');
//     }
//     //function Sign Out(end)

// }
