<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Str;

class AuthController extends Controller
{
    // login
    function login_check()
    {
        if (auth('web')->check()) {
            if (auth('web')->user()->type == 1) {
                return redirect()->route('admin_home')->with('success', "You are already loggen-in!!");
            }
            return redirect()->back()->with('error', "You are not authorized and already logged in!!");
        }
        return view('auth/login');
    }
    function login(Request $request)
    {
        $rules = [
            'email' => 'required | email  | max:100',
            'password' => 'required | min:8'
        ];

        $validations = Validator::make($request->all(), $rules);

        if ($validations->fails()) {
            return back()->with('error', $validations->errors());
        }

        $remember = $request->remember;
        $credentails = $request->only('email', 'password');
        $user = User::where('email', '=', $request->email)->first();
        // dd($user);
        if ($user != null && $user->type == 1) {
            if (auth()->guard('web')->attempt($credentails, $remember)) {
                $request->session()->regenerate();
                return redirect()->route('admin_home')->with('success', "You have been succesfully loggedin.");
            }
            return back()->with('error', 'Email or UserName or Password may be wrong !!');
        }
        return back()->with('error', 'Email or UserName or Password may be wrong !!');
    }

    // forgot password
    function forgotpassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users',
        ]);
        if ($validator->fails()) {
            return back()->with('error', $validator->errors());
        }

        $token = Str::random(64);
        if (DB::table('password_resets')->where('email', '=', $request->email)->first() != null) {

            DB::table('password_resets')->where('email', '=', $request->email)->delete();
            DB::table('password_resets')->insert([
                'email' => $request->email,
                'token' => $token,
                'created_at' => Carbon::now()
            ]);
        } else {
            DB::table('password_resets')->insert([
                'email' => $request->email,
                'token' => $token,
                'created_at' => Carbon::now()
            ]);
        }

        Mail::send('auth/templates/forgot_password', compact('token'), function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Password Reset Link');
        });

        return redirect()->back()->with('success', 'Password Change link has been sent to your email.');
    }

    function verifypassword($token)
    {
        return view('auth/forgot_password_verification', compact('token'));
    }

    function changepassword(Request $request, $token)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users',
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password',
        ]);
        if ($validator->fails()) {
            return back()->with('error', $validator->errors());
        }

        $updatePassword = DB::table('password_resets')
            ->where([
                'email' => $request->email,
                'token' => $token
            ])
            ->first();

        if (!$updatePassword) {
            return back()->with('error', 'Invalid token!');
        }

        User::where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);

        DB::table('password_resets')->where(['email' => $request->email])->delete();

        return redirect()->route('login_screen')->with('success', 'Your password has been changed succesfully!!!');
    }

    // reset password
    function reset_password(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'oldpassword' => 'required',
            'password' => 'required|min:8',
            'confirmpassword' => 'required|same:password',
        ]);
        if ($validator->fails()) {
            return back()->with('error', $validator->errors());
        }

        if (!Hash::check($request->oldpassword, auth('web')->user()->password)) {
            return redirect()->back()->with('error', 'Old Password doesnot match.');
        }

        if (Hash::check($request->password, auth('web')->user()->password)) {
            return redirect()->back()->with('error', "Old password and new password can not be same!!");
        }

        $passwords = $request->password;
        User::where('id', auth('web')->user()->id)->update([
            'password' => Hash::make($request->password)
        ]);

        Mail::send('auth/templates/reset_password', compact('passwords'), function ($message) {
            $message->to(auth('web')->user()->email);
            $message->subject('Password changed Mail');
        });

        return redirect()->back()->with('success', 'Password Changed Succesfully...');
    }

    // profile update
    function profile_update(Request $request)
    {
        if (isset($request->avatar)) {
            $Avatar = time() . '.' . request()->file('avatar')->getClientOriginalExtension();

            request()->avatar->move(public_path('assets/'), $Avatar);
        } else {
            $oldimage = User::where('id', auth('web')->user()->id)->first();
            $Avatar = $oldimage->avatar;
        }

        User::where('id', auth('web')->user()->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'age' => $request->age,
            'gender' => $request->gender,
            'avatar' => $Avatar
        ]);

        return redirect()->back()->with('success', 'Profile Updated successfully...');
    }

    // logout
    function logout(Request $request)
    {
        // Session::flush();
        auth()->guard('web')->logout();
        // $request->session()->invalidate();
        // $request->session()->regenerateToken();
        return redirect()->route('index_page');
    }
}
