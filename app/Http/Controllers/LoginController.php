<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => ['required', 'email'],
            'password' => 'required',
        ]);

        if (Auth::attempt(
            ['email' => $request->email, 'password' => $request->password, 'status' => 'active'],
            $request->filled('remember')
        )) {
            $request->session()->regenerate();

            Auth::user()->update(['last_login_at' => now()]);

            return redirect($this->redirectBasedOnRole());
        }

        return back()->withErrors([
            'email' => 'Invalid credentials or account is inactive.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    // ---------------------------------------------------------------
    // Redirect user to their dashboard based on Spatie role
    // ---------------------------------------------------------------
    private function redirectBasedOnRole(): string
    {
        $user = Auth::user();

        if ($user->hasRole('super_admin')) {
            return route('admin.dashboard');
        }

        if ($user->hasRole('business_admin')) {
            return route('business.dashboard');
        }

        if ($user->hasRole('cashier')) {
            return route('cashier.terminal');
        }

        if ($user->hasRole('customer')) {
            return route('customer.account');
        }

        // Fallback — send to generic dashboard if no recognised role
        return route('dashboard');
    }
}
















 //<//?php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;

// class LoginController extends Controller
// {
//     public function __construct()
//     {
//         // 🚫 Logged-in users cannot access login page
//         $this->middleware('guest')->except('logout');
//     }

//     public function showLoginForm()
//     {
//         return view('auth.login');
//     }
//     public function SadminPages()
// {
//     return view('SadminPages');
// }
//     public function login(Request $request)
//     {
//         $request->validate([
//             'email' => ['required', 'email'],
//             'password' => 'required',
//             'remember' => ['sometimes', 'boolean'],
//         ]);

//         if (Auth::attempt(
//             ['email' => $request->email, 'password' => $request->password, 'status' => 'active'],
//             $request->filled('remember')
//         )) {
//             $request->session()->regenerate();

//             Auth::user()->update(['last_login_at' => now()]);

//             return redirect()->intended(route('dashboard'));
//         }

//         return back()->withErrors([
//             'email' => 'Invalid credentials',
//         ])->onlyInput('email');
//     }

//     public function logout(Request $request)
//     {
//         Auth::logout();
//         $request->session()->invalidate();
//         $request->session()->regenerateToken();

//         return redirect()->route('login');
//     }
// } -->
