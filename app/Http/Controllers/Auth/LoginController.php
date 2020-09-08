<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\Frontend\Auth\Socialite;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Route;
use App\Http\Controllers\Api\ApiController;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/booking';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('frontend.access.login');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function checkLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|alphaNum|min:3'
        ]);

        $user_data = [
            'email' => $request->get('email'),
        ];

        $loginTunn = new ApiController();
        $user_data_tunn = $loginTunn->loginInTunn($request->get('email'), $request->get('password'));
        if ($user_data_tunn['state'] === true) {
            $token = $user_data_tunn['results']['token'];
            $getUserTunn = $loginTunn->getUser($token, $request->get('email'), 'email');

            $user = User::where('customer_id', '=', $getUserTunn['results']['id'])->first();

            if (empty($user)) {
                $user = User::create([
                    'email' => $request->get('email'),
                    'name' => $getUserTunn['results']['firstname'],
                    'password' => Hash::make($request->get('password')),
                    'customer_token' => $token,
                    'customer_id' => $getUserTunn['results']['id'],
                    'customer_num' => $getUserTunn['results']['num'],
                ]);
            }

            if (Auth::loginUsingId($user->id)) {
                $user->customer_token = $token;
                $user->save();
                return redirect('/booking');
            }
        } else {
            dd('Ни чё не вышло');
        }

    }



}
