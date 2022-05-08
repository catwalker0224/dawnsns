<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

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
    protected $redirectTo = '/added';

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
            'username' => 'required|string|min:4|max:12',
            'mail' => 'required|string|email|min:4|max:12|unique:users',
            'password' => 'required|string|regex:/^[a-zA-Z0-9]+$/|min:4|max:12|unique:users',
            'password-confirm' => 'required|string|regex:/^[a-zA-Z0-9]+$/|min:4|max:12|same:password'
        ],[
            // 'required' => 'この項目は入力必須です',
            // 'min:4' => 'この項目は4文字以上です',
            // 'max:12' => 'この項目は12文字以内です',
            // 'unique:users' => 'この項目は登録済み情報使用不可です',
            // 'regex:/^[a-zA-Z0-9]+$/' => 'この項目は英数字のみです',
            // 'same:password' => 'Passwordと一致していません'
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
            'username' => $data['username'],
            'mail' => $data['mail'],
            'password' => bcrypt($data['password']),
        ]);
    }

    // public function registerForm(){
    //     return view("auth.register");
    // }

    public function register(Request $request){
        if($request->isMethod('post')){
            $data = $request->input();
            $val = $this->validator($data);
            if ($val->fails()){
                return redirect('/register')
                    ->withErrors($val)
                    ->withInput();
            }
            $this->create($data);
            return redirect('added')->with('username', $data['username']);
        }
        return view('auth.register');
    }

    public function added(){
        return view('auth.added');
    }
}
