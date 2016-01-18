<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AuthenticateController extends Controller
{
    public function authenticate(Request $request)
    {
        $code = $request->input('activation_code');

        $activation_code = \App\ActivationCodes::where('code', '=', $code)->first();

        if($activation_code != null) {
            if (strpos($activation_code->code,$code)!==false) {

                $validator = Validator::make($request->all(), [
                    'email' => 'required|email|max:255|unique:users',
                    'password' => 'required',
                    'activation_code' => 'required',
                    'first_name' => 'required',
                    'last_name' => 'required',
                ]);

                // Find code in database
                $activation_code = \App\ActivationCodes::find($activation_code->id);
                if ($validator->fails()) {
                    return response()->json($validator->messages(), 403);

                } else if($activation_code->is_used != 0) {
                    $returnData = array(
                        'status' => 'error',
                        'message' => trans('auth.code-used')
                    );
                    return response()->json($returnData, 401);

                } else {
                    $user = new \App\User;
                    $user->first_name = $request->input('first_name');
                    $user->last_name = $request->input('last_name');
                    $user->email = $request->input('email');
                    $user->activation_code = $code;
                    $user->password = bcrypt($request->input('password'));
                    $user->is_admin = false;
                    $user->save();

                    $activation_code->is_used = true;
                    $activation_code->save();

                    $credentials = $request->only('email', 'password');

                    try
                    {
                        // verify the credentials and create a token for the user
                        if (! $token = JWTAuth::attempt($credentials))
                        {
                            return response()->json(['error' => 'invalid_credentials'], 401);
                        }
                    }
                    catch (JWTException $e)
                    {
                        return response()->json(['error' => 'could_not_create_token'], 500);
                    }

                    // Everything is fine send JWT token
                    return response()->json(compact('token'));
                }
            }
        }

        $returnData = array(
            'status' => 'error',
            'message' => trans('auth.code-invalid')
        );

        return response()->json($returnData, 404);

    }

    /**
     * API Login, on success return JWT Auth token
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request) {
        $credentials = $request->only('email', 'password');
        try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['error' => $e->getMessage()], 500);
        }
        // all good so return the token
        return response()->json(compact('token'));
    }

    /**
     * Log out
     * Invalidate the token, so user cannot use it anymore
     * They have to relogin to get a new token
     *
     * @param Request $request
     */
    public function logout(Request $request) {
        $this->validate($request, [
            'token' => 'required'
        ]);

        JWTAuth::invalidate($request->input('token'));

        $returnData = array(
            'status' => 'success',
            'message' => trans('auth.code-blacklisted')
        );

        return response()->json($returnData, 200);
    }
}
