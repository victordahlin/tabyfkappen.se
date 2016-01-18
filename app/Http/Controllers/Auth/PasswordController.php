<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;
    private $redirectTo = '';

    /**
     * Reset the given user's password.
     *
     * @param  Request  $request
     * @return Response
     */
    public function postReset(Request $request)
    {
        $this->validate($request, [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $credentials = $request->only(
            'email', 'password', 'password_confirmation', 'token'
        );

        $response = Password::reset($credentials, function ($user, $password) {
            $user->password = bcrypt($password);
            $user->save();
        });

        switch ($response) {
            case Password::PASSWORD_RESET:
                if(Auth::attempt(['email' => $request->input('email'),
                                  'password' => $request->input('password'),
                                  'is_admin' => 1])) {
                    return redirect('');
                } else {
                    return view('auth.password-changed');
                }

            default:
                return redirect()->back()
                    ->withInput($request->only('email'))
                    ->withErrors(['email' => trans($response)]);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function postEmailRestAPI(Request $request)
    {
        $message = trans('messages.email-sent');
        $response_code = 200;
        $status = 'success';

        if($request->has('email')) {
            $email = \App\User::where('email', '=', $request->input('email'))->count();

            if($email < 1) {
                $status = 'error';
                $message = trans('messages.no-email');
                $response_code = 404;

            } else {
               // Send password link
                Password::sendResetLink($request->only('email'), function (Message $message) {
                    $message->subject(trans('messages.password-reset'));

                });
            }
        } else {
            $status = 'error';
            $message = trans('messages.no-email');
            $response_code = 404;
        }

        $returnData = array(
            'status' => $status,
            'message' => $message
        );
        return response()->json($returnData, $response_code);
    }
}
