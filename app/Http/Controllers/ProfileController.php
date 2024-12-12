<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function create()
    {
        $user = auth()->user();
        return view('admin.profile.profile', ['user' => $user]);
    }


    public function profileUpdate(Request $request)
    {

        $user_id = auth()->user()->id;
        $userdata = User::find($user_id);
        $userdata->name = $request->name;
        $userdata->email = $request->email;
        $userdata->save();

        return response()->json(['status' => true, 'message' => 'User profile successfully updated', 'data' => $userdata]);
    }

    public function profileUpdatePassword(Request $request)
    {

        // Get the authenticated user
        $authUser = Auth::user();

        // Validate the input fields
        $request->validate([
            'current_password' => 'required|min:6|max:8',
            'new_password' => 'required|min:6|max:8|confirmed', // This rule automatically checks for matching 
            'new_password_confirmation' => 'required|min:6|max:8', // If you want to add extra rules for confirmation
        ]);

        // Check if the current password matches
        if (!Hash::check($request->current_password, $authUser->password)) {
            return response()->json([
                'status' => false,
                'message' => 'The current password does not match with previous password',
            ], 400);
        }

        // Update the password
        $authUser->update([
            'password' => Hash::make($request->new_password),
        ]);

        // Return success response
        return response()->json([
            'status' => true,
            'message' => 'Password successfully updated.',
        ]);
    }
}
