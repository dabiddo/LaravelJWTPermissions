<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetAuthProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Resources\UserResource;

class AuthController extends Controller
{
    /*
     * Register new User
     */
    public function register(Request $request)
    {
        $user = new User();
        $user->email = $request->email;
        $user->name = $request->name;
        $user->password = bcrypt($request->password);
        $user->save();

        return shovel(new UserResource($user));
    }

    /*
     * Login User return JWT
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if ( ! $token = JWTAuth::attempt($credentials)) {
            return shovel()->withError('Invalid Credentials',422);
        }
        return shovel(['token'=>$token]);
       /* return response([
            'status' => 'success',
            'token' => $token
        ]);*/
    }

    /*
     * Return Authenticated User
     */
    public function user(Request $request)
    {
        $user = User::find(Auth::user()->id);
        return shovel($user);
    }

    /*
     * Log out user
     */
    public function logout()
    {
        JWTAuth::invalidate();
        return shovel(['message'=>'Logged out successfully'],200);
    }

    /*
     * Refresh JWT
     */
    public function refresh()
    {
        return shovel(['message'=>'success'],200);
    }

    public function profile(GetAuthProfileRequest $request)
    {
        return shovel(['msg'=>'Hola'],200);
    }
}
