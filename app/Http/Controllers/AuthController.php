<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\User;




class AuthController extends Controller
{
     /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('jwt', ['except' => ['login','signup']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)

    {

        $request->validate([
            'email'    => 'required',
            'password' => 'required',

        ]);

        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'This email Or password is invalid !'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function signup(Request $request){
       
         $request->validate([
                         'firstName'=> 'required|max:255',
                         'lastName' => 'required|max:255',
                         'email'    => 'required|unique:users|max:255',
                         'password'         => 'required|min:8',
                         'password_confirm' => 'required|same:password'   

        ]);
    
        User::create([
            // 'firstName'=>$request->firstName,
            // 'lastName'=>$request->lastName,
            'name'=>$request->firstName." ".$request->lastName,
            'email'=>$request->email,
            'password' => Hash::make($request->password)
            
        ]);

        return $this->login($request);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());


    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'name' =>auth()->user()->name,
            'email' =>auth()->user()->email,
            'user_id' =>auth()->user()->id,



        ]);
    }
}
