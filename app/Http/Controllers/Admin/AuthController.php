<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Registered;

use Illuminate\Support\Facades\DB;


use Carbon\Carbon;




use Illuminate\Support\Str;

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
            'password' => 'required',
        ], [
            'email.required' => 'The email field is required',
            'password.required' => 'The password field is required'
        ]);

        if (Auth()->attempt(["email" => $request->email, "password" => $request->password])) {
            return response()->json([
                'success' => true,
                'redirect_url' => '/',
                'message' => 'User Login Successfully'
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
            'password' => ['required', 'confirmed', 'min:6', 'max:8'],
            'password_confirmation' => 'required',
            'terms' => 'required|accepted', // Ensures checkbox is checked
        ]);


        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        // event(new Registered($user));



        // Send email verification link
        $user->sendEmailVerificationNotification();

        return response()->json(['success' => true, 'redirect_url' => 'login', 'message' => 'User Registered successfully', 'data' => $user]);
    }


    public function forgotPpasswordCreate()
    {
        return view('admin.auth.forgot-password', [
            'status' => session('status'),
        ]);
    }

    public function forgotPpasswordStore(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        $token = Str::random(64);

        DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        Mail::send('admin.auth.forgot-password', ['token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Reset Password');
        });

        return back()->with('message', 'We have e-mailed your password reset link!');
    }
}
