<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Models\User;
use Illuminate\Auth\Events\Registered;

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

    protected $redirectTo = '/notice';

    /**
     * Display register page.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('auth.register');
    }

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
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'birthday' => ['required'],
        ],[
            'name.required' => 'A könyv címének megadása kötelező',
            'name.string' => 'Csak a magyar ABC szerinti karaktereket adjon meg',
            'name.max' => 'A név hossza maximum 255 karakter lehet',
            'email.required' => 'Az email cím megadása kötelező',
            'email.string' => 'Az email cím formátuma nem megfelőle',
            'email.email' => 'Az email cím formátuma nem megfelőle',
            'email.max' => 'Az email cím hossza maximum 255 karakter lehet',
            'email.unique' => 'Ez az email cím már foglalt',
            'password.required' => 'A jelszó megadása kötelező',
            'password.string' => 'A jelszó formátuma nem megfelőle',
            'password.min' => 'A jelszónak legalább 8 karakter hosszúnak kell lennie ',
            'password.confirmed' => 'Különböző jelszót adott meg',
            'birthday.required' => 'A születési idő megadása kötelező megadása kötelező',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'birthday' => $data['birthday'],
        ]);
    }
}
