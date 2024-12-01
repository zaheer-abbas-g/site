<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class AuthController extends Controller
{
    public function create()
    {
        return view('admin.auth.login');
        // return view('auth.login');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ], [
            'email.required' => 'The email field is required',
            'password.required' => 'The password field is required'
        ]);

        if (Auth()->attempt(["email" => $request->email, "password" => $request->password])) {
            return response()->json([
                'success' => true,
                'redirect_url' => '/'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Invalid email or password'
            ]);
        }
    }




    /**
     * Destroy an authenticated session.
     */
    public function destroy() {}

    public function registerCreate()
    {
        return view('admin.auth.register');
    }

    public function registerStore(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
    }
}
