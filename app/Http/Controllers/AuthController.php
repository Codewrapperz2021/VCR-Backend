<?php

namespace App\Http\Controllers;

use App\Models\User;
use Laravel\Socialite\Facades\Socialite;

use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Validation\Rules\Password;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Exception;

class AuthController extends Controller
{
    public function register(Request $request) {
        {
            $request->validate([
    
            ]);
            $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string',
            'role' => 'string',
            'profileimage' => ''
        ]);

        $name=$request->name;
        $image=$request->file("file");
        $imageName = time().'.'.$image->extension();
        $image->move(public_path('images'),$imageName);

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'role' => $fields['role'],
            'password' => bcrypt($fields['password']),
            'profileimage'=> $fields['profileimage'] = $imageName            
        ]);

        $response = [
            'user' => $user
            
        ];

        return response($response, 200);
         
        }
        
    }


    public function logout(Request $request)
    {

        $request->user()->tokens()->delete();

        return response()->json(
            [
                'message' => 'Logged out'
            ]
        );

    }

    public function login(LoginRequest $request) {

        $request->authenticate();
        $token = $request->user()->createToken('mytoken');

        return response()->json(
            [
                'message'=>'logged in',
                'data'=> [
                    'user'=>$request->user(),
                    'token'=>$token->plainTextToken
                ]
            ]
                );
    
        // $fields = $request->validate([
        //     'email' => 'required|string',
        //     'password' => 'required|string'
        // ]);

        // // Check Email
        
        // $user = User::where('email',$fields['email'])->first();

        // // Check Password
        // if(!$user || !Hash::check($fields['password'], $user->password)) {
        //     return response([
        //         'message' => 'Bad Credentials'
        //     ],401);
        // }

        // $token = $user->createToken('myapptoken')->plainTextToken;
        
        // $this->response= [
        //     'user' => $user,
        //     'token' => $token,
            
        // ];

        // return response($this->response, 200);
    }

    public function sendVerificationEmail(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return [
                'message' => 'Already Verified'
            ];
        }
        $request->user()->sendEmailVerificationNotification();
        return [ 'status' => 'verification link sent'];
    }

    public function verify(EmailVerificationRequest $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return [
                'message' => 'Email already verified'
            ];
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return [
            'message'=>'Email has been verified'
        ];
    }


    //Google Login
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    //Google Callback
    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->user();

        $this->_registerOrLoginUser();
        return redirect()->route('localhost:3000/studentdashboard');
    }

    //Facebook Login
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    //Facebook Callback
    public function handleFacebookCallback()
    {
        $user = Socialite::driver('facebook')->user();

        $this->_registerOrLoginUser();
        return redirect()->route('localhost:3000/studentdashboard');
    }

    
    //Github Login
    public function redirectToGithub()
    {
        return Socialite::driver('github')->redirect();
    }



    //Github Callback
    public function handleGithubCallback()
    {
        $user = Socialite::driver('github')->user();

        $this->_registerOrLoginUser();
        return redirect()->route('localhost:3000/studentdashboard');
    }


    protected function _registerOrLoginUser($data)
    {
        $user = User::where('email', '=' , $data->email)->first();
        if($user) {
            $user = new User();
            $user->name = $data->name;
            $user->email = $data->email;
            $user->provider_id = $data->id;
            $user->profileimage = $data->avatar;
            $user->save();

        }
        Auth::login($user);
    }

}
