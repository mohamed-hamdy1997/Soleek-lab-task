<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use JWTAuth;
use JWTAuthException;
use App\User;
use Countries;
class ApiController extends Controller
{
protected $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }
    
    public function login(Request $request){
        $credentials = $request->only('email', 'password');
        $token = null;
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    'response' => 'error',
                    'message' => 'invalid_email_or_password',
                ]);
            }
        } catch (JWTAuthException $e) {
            return response()->json([
                'response' => 'error',
                'message' => 'failed_to_create_token',
            ]);
        }
        return response()->json([
            'response' => 'success',
            'result' => [
                'token' => $token,


                
            ],
        ]);
    }

    public function register(Request $request)
    {
       
        
        $user= new User();
        $user->name= $request->input('name');
        $user->email=$request->input('email');
        
        
        $user->password=app('hash')->make($request->input('password'));

        $user->save();
           return response()->json(['status' =>'success','user'=>$user]);

          
        }

        public function getCountries()
        {
        		return Countries::getList('en', 'json');

        }
 }
        


