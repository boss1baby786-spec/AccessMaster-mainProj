<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    
public function showForgotForm()
{
return view('auth.forgot-password');
}
public function sendResetLink(Request $request)
{
$request->validate([
    'email'=>'required|email|exists:users,email'
]);
$token=Str::random(64);
DB::table('password_resets')->updateOrInsert(
[
'email'=>$request->email
],
[
'token'=>$token,
'created_at'=>now(),
]
);
$resetUrl = url('reset-password/' . $token . '?email=' . $request->email);

// **************************FOR SENDING MAIL******************************************

Mail::send('emails.reset-password', ['url' => $resetUrl], function ($message) use ($request) {
        $message->to($request->email);
        $message->subject('Reset Your Password');
    });
return back()->with('success',"Password reset link has been sent to your email.");
}
public function showResetForm($token)
{

 return view('auth.reset-password', [
        'token' => $token,
        'email' => request('email'),
    ]);

}
public function resetPassword(Request $request)
{
$request->validate([
    'token'=>'required',
    'password'=>'required|min:6|confirmed'
]);

$passwordReset=DB::table('password_resets')->where('token',$request->token)->first();
   
if(!$passwordReset)
    {
        return back()->withErrors(['token','InValid Token']);
    }
$user=User::where('email',$passwordReset->email)->first();

$user->password=Hash::make($request->password);
$user->save();
return redirect()->route('login')->with('success', 'Password updated successfully!');
}

}
