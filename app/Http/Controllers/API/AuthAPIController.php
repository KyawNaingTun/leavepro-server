<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use App\Http\Controllers\Controller;
//models
use App\Models\Employee;
use Modules\Freelancer\Models\Freelancer;
//externals
use Hash;
use Auth;
use Carbon\Carbon;

class AuthAPIController extends Controller
{

    /**
     * Registration
     */
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:20',
            // 'department' => 'max:30',
            // 'role' => 'max:30',
            // 'phone' => 'max:20',
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        $user = Employee::create([
            'name' => $request->name,
            'department' => $request->department,
            'role' => $request->role,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $token = $user->createToken('LaravelAuthApp')->accessToken;

        // return response()->json(['token' => $token], 200);
        return $this->respondWithToken($token, $user);
    }
    
    // /**
    //  * Login
    //  */
    // public function login(Request $request)
    // {
    //     $data = [
    //         'email' => $request->email,
    //         'password' => $request->password
    //     ];
 
    //     if (auth()->attempt($data)) {
    //         $token = auth()->user()->createToken('LaravelAuthApp')->accessToken;
    //         return response()->json(['token' => $token], 200);
    //     } else {
    //         return response()->json(['error' => 'Unauthorised'], 401);
    //     }
    // }

    /**
     * Login
     *
     * @param Request $request
     * @return void
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $user = Employee::where('email', $request->email)->first();

        if ($user) {
            $credentials = $request->only('email', 'password');
            
            if (auth()->attempt($credentials)) {//auth check
                $token = auth()->user()->createToken('LaravelAuthApp')->accessToken;
                return response()->json([
                    'code' => 'A',
                    'success' => true,
                    'token' => 'Bearer '.$token,
                    'user' => $user,
                    'message' => 'Login success'
                ]);
            }else{
                $response = [
                    'code' => 'R',
                    'success' => false,
                    'message' => 'Password missmatch'
                ];
                return response()->json($response);
            }
            
        } else {
            $response = [
                'code' => 'R',
                'success' => false,
                'message' => 'User doesn\'t exist! Please create a new account.'
            ];
            return response()->json($response);
        }
    }
    
    /**
     * Logout
     *
     * @return void
     */
    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }
    /**
     * Refresh token
     *
     * @return void
     */
    public function refreshToken()
    {
        $token = auth()->refresh();
        return $this->respondWithToken($token);
    }
    /**
     * Respond with token
     *
     * @param [type] $token
     * @param [type] $user
     * @return void
     */
    protected function respondWithToken($token, $user = null)
    {
        if ($user) {
            return response()->json([
                'user' => $user,
                'access_token' => 'Bearer '.$token,
                'token_type' => 'bearer',
            ], 200);
        }
        return response()->json([
            'access_token' => 'Bearer '.$token,
            'token_type' => 'bearer',
        ], 200);
    }
    
}