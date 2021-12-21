<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Exception;

class AuthController extends Controller
{
    public $response;
    public function register(Request $request) {
        {
            $request->validate([
    
            ]);
            $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
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


    public function logout(Request $request) {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Logged Out'
        ];
    }

    public function login(Request $request) {
    
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        // Check Email
        
        $user = User::where('email',$fields['email'])->first();

        // Check Password
        if(!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Bad Credentials'
            ],401);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;
        
        $this->response= [
            'user' => $user,
            'token' => $token,
            
        ];

        return response($this->response, 200);
    }


    public function getProfile(){
            {
            
                // $name = $request->user()->ame;
        
                $res = $this->response;
                return $res;
    
            }
    }


}
