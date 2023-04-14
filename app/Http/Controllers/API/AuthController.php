<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;
use Exception;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api'], ['except' => ['login', 'register']]);
    }

    public function register(Request $request)
    {
        $rules = [
            'name' => 'required | max:20 | min:2',
            'email' => 'required | email  | max:50',
            'mobile' => 'required ',
            'password' => 'required | min:8 | max:30',
            'confirm_password' => 'required | same:password'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => $validator->errors()
            ]);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'password' => Hash::make($request->password)
        ]);

        return response()->json([
            'message' => 'User registered succesfully!!',
            'data' => $user,
            'status' => 201
        ]);
    }

    public function login(Request $request)
    {
        if ($request->mobile) {
            $rules = [
                'mobile' => 'required | integer | digits_between:10,12 | exists:users',
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status' => 400,
                    'error' => $validator->errors()
                ]);
            }

            $verificationCode = $this->generateOtp($request->mobile_no);

            Log::info(message: "otp= " . $verificationCode->otp);
            return response()->json([
                'message' => 'OTP sent on your registered mobile number!!',
                'data' => $verificationCode,
                'status' => 200
            ]);
        }

        $rules = [
            'email' => 'required | email | max:50 | exists:users',
            'password' => 'required | min:8 | max:30',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => $validator->errors()
            ]);
        }
        if (!$token = auth()->attempt($validator->validated())) {
            return response()->json([
                'message' => 'Email or Password may be worng.',
                'status' => 404
            ]);
        }

        return $this->createNewToken($token);
    }

    public function generateOtp($mobile_no)
    {
        $user = User::where('mobile_no', $mobile_no)->first();
        // $user = User::where('mobile', '=', $request->mobile)->first();
        if ($user == null) {
            return response()->json([
                'status' => 404,
                'error' => 'Mobile Number not found, please register!'
            ]);
        }

        # User Does not Have Any Existing OTP
        $now = Carbon::now();

        if ($user && $now->isBefore($user->expire_at)) {
            return $user;
        }

        // Create a New OTP
        return User::where('mobile', '=', $mobile_no)->update([
            'otp' => rand(1000, 9999),
            'expire_at' => Carbon::now()->addMinutes(10)
        ]);
    }

    public function verify_otp(Request $request, $user_id)
    {
        $rules = [
            'user_id' => 'required',
            'otp' => 'required | length:4'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
                'status' => 400
            ]);
        }
        #Validation Logic
        $user   = User::where('id', $user_id)->where('otp', $request->otp)->first();

        $now = Carbon::now();

        if (!$user) {
            return response()->json([
                'message' => 'OTP is not valid',
                'status' => 404
            ]);
        } elseif ($user && $now->isAfter($user->expire_at)) {
            return response()->json([
                'message' => 'Your OTP has been expired',
                'status' => 404
            ]);
        }

        if ($user) {
            $user->update([
                'otp' => '',
                'expire_at' => Carbon::now()
            ]);
        }

        $token = Auth::login($user);

        return $this->createNewToken($token);
    }

    public function createNewToken($token)
    {
        // $token = auth()->setTTL(60)->attempt($credentials);
        return response()->json([
            'message' => "Login Succesfully!!",
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user(),
            'status' => 200
        ]);
    }

    public function forgot_password(Request $request)
    {
        $rules = [
            'email' => 'required|email|exists:users'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors(),
                'status' => 422
            ]);
        }
        $otp = rand(1000, 9999);
        $user = User::where('email', '=', $request->email)->first();
        if ($user == null) {
            return response()->json([
                'status' => 404,
                'message' => 'Email is not authorized'
            ]);
        }
        $user->update(['otp' => $otp]);

        Mail::to($request->email)->send(new MailOtpVerifyMail($user));
        return $this->successResponse('Email Sent!', 200);
    }

    // google auth
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    public function handleGoogleCallback(Request $request)
    {
        try {

            $user = Socialite::driver('google')->user();

            $finduser = User::where('google_id', $user->id)->first();

            if ($finduser) {

                Auth::login($finduser);

                return response()->json([
                    'token' => $finduser,
                    'token_type' => 'bearer',
                    'message' => "You have succesfully logged in!!",
                    'data' => auth()->user(),
                    'status' => 200,
                ]);
            } else {
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id' => $user->id,
                    'password' => Hash::make($request->password)
                ]);

                Auth::login($newUser);

                return response()->json([
                    'token' => $finduser,
                    'token_type' => 'bearer',
                    'message' => "You have succesfully logged in!!",
                    'data' => auth()->user(),
                    'status' => 200,
                ]);
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    // facebook
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }
    public function handleFacebookCallback(Request $request)
    {
        try {

            $user = Socialite::driver('facebook')->user();

            $finduser = User::where('facebook_id', $user->id)->first();

            if ($finduser) {

                Auth::login($finduser);

                return response()->json([
                    'token' => $finduser,
                    'token_type' => 'bearer',
                    'message' => "You have succesfully logged in!!",
                    'data' => auth()->user(),
                    'status' => 200,
                ]);
            } else {
                $newUser = User::updateOrCreate(['email' => $user->email], [
                    'name' => $user->name,
                    'email' => $user->email,
                    'facebook_id' => $user->id,
                    'password' => Hash::make($request->password)
                ]);

                Auth::login($newUser);

                return response()->json([
                    'token' => $finduser,
                    'token_type' => 'bearer',
                    'message' => "You have succesfully logged in!!",
                    'data' => auth()->user(),
                    'status' => 200,
                ]);
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
