<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\User\RegistrationToken;
use Illuminate\Http\Request;
use Auth;
use DB;
use App\Mail\UserRegistration;

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
    protected $redirectTo = '/';

    protected $token;
    protected $user;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(RegistrationToken $token, User $user)
    {
        $this->middleware('guest');
        $this->token = $token;
        $this->user = $user;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Directs user to registration page
     *
     * @return \user\register.blade.php
     */
    protected function showRegistrationForm() {
        return view ('auth.register');
    }

    /**
     * Logs the current user out of the application
     *
     * @return  view    \index.blade.php
    */
    protected function logout() {
        Session::flush(); 
        return Redirect::to('/');
    }

    /**
     * Registers the user in the application with the provided credentials
     *
     * @param Request $request
     * @return  view    \index.blade.php
     */
    protected function register(Request $request)
    {
        $validator = $this->validator($request->all());
        $email = $request->get('email');

        // assert that the email is not already registered
        if ($this->user->where('email', $email)->exists()) {
            \Session::flash('message', "$email is already registered!");
            return back()->withInput();
        }

        DB::transaction(function() use ($email) {
            // delete any previous tokens associated with this email
            $this->token->where('email', $email)->get()->each(function ($t) {
                $t->delete();
            });

            // create a new token and mail it
            $token = $this->token->create(compact('email'));
            Mail::to($email)->send(new UserRegistration($token));
        });

        \Session::flash('message', "Registration email sent to $email");

        return redirect($this->redirectPath());
    }

    public function createUser(Request $request, $tokenString)
    {
        // grab token from database using passed token string
        $token = $this->token->where('token', $tokenString)->firstOrFail();
        $email = $token->email;

        return view('user.create', [
            'token' => $token->token,
            'email' => $token->email,
        ]);
    }

    public function completeRegistration(Request $request)
    {
        // grab token from database using passed token string
        $token = $this->token->where('token', $request->get('token'))->firstOrFail();

        if ($request->get('email') != $token->email) {
            abort(403, 'Unauthorized email ' . $request->get('email') . ' for registration token');
        }

        $data = $request->all();

        // validate inputs
        $validator = $this->validator($data);;

        // create the new user, delete the token, login
        DB::transaction(function () use ($token, $data) {
            $user = $this->user->create(array_merge($data, [
                'password' => bcrypt($data['password']),
            ]));
            $token->delete();
            Auth::login($user);
        });

        \Session::flash('message', 'Registration complete! You are now logged in.');
        return redirect($this->redirectPath());
    }
}
