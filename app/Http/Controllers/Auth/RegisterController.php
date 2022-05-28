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

    public function register(Request $request){
        if($request->isMethod('post')){
            $data = $request->input();
            $validator = Validator::make($data, [
                'username' => 'required|string|min:4|max:12',
                'mail' => 'required|string|email|min:4|max:12|unique:users',
                'password' => 'required|string|regex:/^[a-zA-Z0-9]+$/|min:4|max:12|unique:users',
                'password-confirm' => 'required|string|regex:/^[a-zA-Z0-9]+$/|min:4|max:12|same:password',
            ]);
        if($validator->fails()){
            return redirect('/register')
                ->withErrors($validator)
                ->withInput();
            }
            User::create([
                'username' => $data['username'],
                'mail' => $data['mail'],
                'password' => bcrypt($data['password']),
            ]);
            return redirect('/added')
                ->with('username', $data['username']);
        }
        return view('auth.register');
    }

    public function added(){
        return view('auth.added');
    }
}
