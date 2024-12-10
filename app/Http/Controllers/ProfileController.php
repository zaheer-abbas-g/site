<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
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

        $authUser = auth()->user();

        $user = new User();

        if (!Hash::check($request->current_password, $authUser->password)) {
            return response()->json(['status' => false, 'message' => 'The current password does not match', 'data' => $authUser], 400);
        }

        $request->validate([
            'current_password' => 'required',
            'new_password' => "required|min|confirmed"
        ]);

        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        return response()->json(['status' => true, 'message' => 'User Password successfully updated', 'data' => $authUser]);
    }
}
