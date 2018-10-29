<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    public function __construct()
    {

        //$this->middleware('auth');
        if (Auth::check()) {
            //return Redirect::to('/');
        }
    }


    public function index()
    {
        return view('pages.frontpage.index');
    }

    public function login()
    {
        return view('pages.login.login');
    }

    public function register()
    {
        return view('pages.login.register');
    }

    public function store(Request $request)
    {
        unset($request['_token']); //Remove Token

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);
        $request->request->add(['password' => Hash::make($request['password'])]);
        try {
            $id = User::insertGetId($request->all());
            $request->session()->put('id', $id);
            return Redirect::to('/home');

        } catch (\Exception $exception) {
            return back()->with("failed", "There is an Error");
        }
        return $request->all();
    }

    public function doLogin(Request $request)
    {

        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $email = $request['email'];
        $password = $request['password'];
        $remember = true;

        if (Auth::attempt(['email' => $email, 'password' => $password], $remember)) {

            $user = User::where('email', $email)->first();
            $request->session()->put('id', $user->id);
            return Redirect::to('/home');
        } else {
            return back()->with('failed', "Email or password does not match");

        }
    }

    public function doLogout()
    {
        Auth::logout(); // log the user out of our application
        return Redirect::to('/');
    }


}
