<?php

namespace App\Http\Controllers;

use App\Helper\JWTToken;
use App\Mail\OTPMail;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;


class UserController extends Controller
{
    function LoginPage():View{
        return view('pages.auth.login-page');
    }
    function SignupPage():View{
        return view('pages.auth.signup-page');
    }
    function SendOtpPage():View{
        return view('pages.auth.send-otp-page');
    }
    function VerifyOtpPage():View{
        return view('pages.auth.verify-otp-page');
    }
    function ResetPasswordPage():View{
        return view('pages.auth.reset-pass-page');
    }

    function DashboardPage():View{
        return view('pages.dashboard.dashboard-page');
    }

    function ProfilePage():View{
        return view('pages.dashboard.profile-page');
    }



    function UserLogout()
    {
        return redirect('/userLogin')->cookie('token','',-1);
    }










    function UserSignup(Request $request)
    {

        try {
            User::create([
                'firstName' => $request->input('firstName'),
                'lastName' => $request->input('lastName'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'password' =>  Hash::make($request->input('password'))
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'User Signup Successfully'
            ], 200);

        } catch (Exception $exception) {
            return response()->json([
                'status' => 'failed',
                'message' => 'User Signup Failed'
//                'message' => $exception->getMessage()
            ], 401);
        }
    }


    function UserLogin(Request $request){
        $user = User::where('email', $request->input('email'))->first();

        if ($user && Hash::check($request->input('password'), $user->password)) {
            // Successful login
            $token = JWTToken::CreateToken($request->input('email'), $user->id);
            return response()->json([
                'status' => 'success',
                'message' => 'User Login Successful',
            ])->cookie('token', $token, 60 * 24 * 30);
        } else {
            // Incorrect credentials
            return response()->json([
                'status' => 'failed',
                'message' => 'Invalid email or password',
            ], 401);
        }
    }



    function SendOTPCode(Request $request){
        $email=$request->input('email');
        $otp=rand(100000,999999);
        $count=User::where('email','=',$email)->count();

        if($count==1){
                // OTP Email Address
                Mail::to($email)->send(new OTPMail($otp));
                // OTP Code Table Update
                User::where('email','=',$email)->update(['otp'=>$otp]);

                return response()->json([
                    'status' => 'success',
                    'message' => '6 Digit OTP Code has been send to your email !'
                ],200);
        }
        else{
            return response()->json([
                'status'=>'failed',
                'message'=>'unauthorized'
            ],200);
        }
    }

    function VerifyOTP(Request $request){
        $email = $request->input('email');
        $otp = $request->input('otp');
        $count = User::where('email', '=', $email)
            ->where('otp', '=', $otp)
            ->count();

        if ($count==1){
            // Database OTP Update
            User::where('email','=',$email)->update(['otp'=>'0']);

            // Password Reset Token Issue
            $token=JWTToken::CreateTokenForSetPassword($request->input('email'));
            return response()->json([
                'status'=>'success',
                'message'=>'OTP Verification Successful',
            ], 200)->cookie('token',$token,60*24*30);
        }
        else{
            return response()->json([
                'status'=>'failed',
                'message'=>'unauthorized'
            ],401);
        }
    }

    function ResetPassword(Request $request)
    {
        try {
            $email = $request->header('email');
            $password = $request->input('password');

            User::where('email', $email)->update(['password' => Hash::make($request->input('password'))]);

            return response()->json([
                'status' => 'success',
                'message' => 'Password Reset Successful',
            ], 200);

        } catch (Exception $exception) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Password Reset Failed',
            ], 401);
        }
    }


    function UserProfile(Request $request)
    {
        $email = $request->header('email');
        $user = User::where('email', '=', $email)->first();

        if (!$user) {
            return response()->json([
                'status' => 'failed',
                'message' => 'User not found'
            ], 404);
        }


        $userData = $user->toArray(); // Convert user model to array
        $userData['password'] = $user->password; // Include hashed password

        return response()->json([
            'status' => 'success',
            'message' => 'Request Successful',
            'data' => $userData
        ], 200);
    }

    function UpdateProfile(Request $request){
        try {
            $email = $request->header('email');

            $firstName = $request->input('firstName');
            $lastName = $request->input('lastName');
            $phone = $request->input('phone');
            User::where('email','=',$email)->update([
                'firstName'=>$firstName,
                'lastName'=>$lastName,
                'phone'=>$phone,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Update Successful'
            ], 200);

        } catch (Exception $exception) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Update Failed'
//                'message' => $exception->getMessage()
            ], 401);
        }
    }
}
