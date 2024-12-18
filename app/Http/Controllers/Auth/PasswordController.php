<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Rules\Password as PasswordRule;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('status', 'password-updated');
    }
    public function showLinkRequestForm()
    {

        return view('admin.auth.forgot-password');  // Show the email form

    }

    public function sendResetLinkEmail(Request $request)
    {
        // Validate the email
        $request->validate(['email' => 'required|email']);


        // Send the reset password link using Laravel's Password facade
        $status  = Password::sendResetLink(
            $request->only('email')  // Only pass the email to the reset link sender
        );

        // Check if the email was sent successfully
        if ($status === Password::RESET_LINK_SENT) {
            return redirect()->back()->with('success', trans($status));
        } else {
            return redirect()->back()->with('error', trans($status));
        }
    }


    public function   showResetForm(Request $request, $token)
    {

        // Pass the token and email to the reset password form
        return view('admin.auth.reset-password', [
            'token' => $token,
            'email' => $request->email,
        ]);
    }
    public function   reset(Request $request)
    {
        // Validate the reset request
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => ['required', 'confirmed', PasswordRule::defaults()],
        ]);


        // Attempt to reset the user's password
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request->password),
                    'remember_token' => Str::random(60),
                ])->save();
            }
        );

        // Check the status and return response accordingly
        if ($status == Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('success', 'Your password has been reset successfully!');
        }

        throw ValidationException::withMessages([
            'email' => [trans($status)],
        ]);
    }
}
