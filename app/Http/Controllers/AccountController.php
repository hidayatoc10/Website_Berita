<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AccountController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('account.index', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('account.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $validated = (object) $request->validate([
            'name' => 'required|max:255',
            'password' => 'nullable|confirmed|min:8',
        ]);

        try {
            DB::beginTransaction();
            $user = User::find(Auth::user()->id);
            $user->name = $validated->name;
            if ($validated->password) {
                $user->password = $validated->password;
            }
            $user->update();
            DB::commit();

            return redirect(route('account.index'))->with([
                'message' => 'Your account has updated.'
            ]);
        } catch (QueryException) {
            DB::rollback();
            return redirect()->back()->withErrors([
                'message' => 'Something went wrong'
            ]);
        }
    }
}


