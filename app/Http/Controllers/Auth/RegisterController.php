<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Api\ApiController;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    /**
     * Show the application's register form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegisterForm()
    {
        return view('frontend.pages.account.create-account');
    }

    /**
     * Show the application's register form.
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function registerForm(Request $request)
    {
        $loginTunn = new ApiController();
        $user_data_tunn = $loginTunn->addCustomer($request);
        if ($user_data_tunn['state'] === true) {
            $token = $user_data_tunn['results']['token'];
            $user = User::where('customer_id', '=', $user_data_tunn['results']['id'])->first();

            if (empty($user)) {
                $user = User::create([
                    'email' => $request->get('email'),
                    'name' => $user_data_tunn['results']['firstname'],
                    'password' => Hash::make($request->get('password')),
                    'customer_token' => $token,
                    'customer_id' => $user_data_tunn['results']['id'],
                    'customer_num' => $user_data_tunn['results']['customer_num'],
                ]);
            }

            if (Auth::loginUsingId($user->id)) {
                $user->customer_token = $token;
                $user->save();
                return redirect('/booking');
            }
        } else {
            return redirect('login');
        }
    }

}
