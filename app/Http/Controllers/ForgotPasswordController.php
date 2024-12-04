<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Notifications\Messages\MailMessage;

class ForgotPasswordController extends Controller
{

    public function showLinkRequestForm()
    {
        return view('admin.auth.passwords.email');  // Show the email form
    }

    public function sendResetLinkEmail(Request $request)
    {
        // Validate the email
        $request->validate(['email' => 'required|email']);


        // Send the reset password link using Laravel's Password facade
        $resetUrl = Password::sendResetLink(
            $request->only('email')  // Only pass the email to the reset link sender
        );

        return (new MailMessage)
            ->subject('Password Reset Request')
            ->view('admin.auth.emails', ['resetUrl' => $resetUrl]); // Pass 
    }
}
