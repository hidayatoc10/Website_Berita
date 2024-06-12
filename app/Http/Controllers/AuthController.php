<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login ()
    {
        return view('login');
    }

    public function loginProcess (Request $request)
    {
        if (isset($request->email) && isset($request->password)) {
            $user = User::where('email', $request->email)->first();
            if ($user && Hash::check($request->password, $user->password)) {
                Auth::login($user);
                return redirect(route('post.index'));
            }
        }
        return redirect()->back()->withErrors([
            'message' => 'Login failed!',
        ]);
    }

    public function register ()
    {
        return view('register');
    }

    public function registerProcess (Request $request)
    {
        $validated = (object) $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:8',
        ]);

        try {
            DB::beginTransaction();
            $user = new User();
            $user->name = $validated->name;
            $user->email = $validated->email;
            $user->password = $validated->password;
            $user->save();
            DB::commit();

            return redirect(route('auth.login'))->with([
                'message' => 'An account has been created for you, ' . $validated->name . '.'
            ]);
        } catch (QueryException) {
            DB::rollback();
            return redirect()->back()->withErrors([
                'message' => 'Something went wrong'
            ]);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect(route('auth.login'));
    }
}



