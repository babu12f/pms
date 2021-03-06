<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class AuthController extends Controller
{
    /**
     * Return Registration Form
    **/
    public function getRegister()
    {
        return view('auth.register');
    }

    /**
     * Return Login From
     **/
    public function getLogin()
    {
        return view('auth.login');
    }

    /**
     * Logout User
     * And Redirect to Index
    **/
    public function logOut()
    {
        Auth::logout();

        return redirect()->route('index');
    }

    /**
     * Create User and Validation
     * @param  Request $request
     * @return Redirct to index with a message
     *
     **/
    public function postRegister(Request $request)
    {
        //Validate Registraion from
        $this->validate($request, [
            'email' => 'required|unique:users|email|max:255',
            'username' => 'required|unique:users|alpha_dash|max:20',
            'password' => 'required|min:6',
        ]);

        //Save data to database
        User::create([
            'email' => $request->input('email'),
            'username' => $request->input('username'),
            'password' => bcrypt($request->input('password'))
        ]);

        //Redirect to index
        return redirect()
            ->route('index')
            ->withInfo('Your account has been created and you can now sign in');
    }

    /**
     * Process login data and login user
     * @param  Request $request
     * @return after successful login Redirect to projects/index otherwise Redirect to back
     *
     **/
    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);

        $authStatus = Auth::attempt($request->only(['email', 'password']), $request->has('remember'));
        if (!$authStatus) {
            return redirect()->back()->with('warning', 'Invalid Email or Password');
        }

        return redirect()->route('projects.index')->with('info', 'You are now signed in');
    }
}
