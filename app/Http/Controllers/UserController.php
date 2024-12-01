<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use DataTables;


class UserController extends Controller
{
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $users = User::latest()->get(); // Ensure User model and data fetching is correct
            return DataTables::of($users)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editUser"><i class="mdi mdi-pencil-box" aria-hidden="true"></i></a>';

                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteUser"><i class="mdi mdi-trash-can"></i></a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.dashboard');
    }


    public function edit($id)
    {
        $user = User::find($id);
        return response()->json($user);
    }

    public function update(Request $request, $id)
    {

        $user = user::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->update();
        return response()->json(['message' => 'User data successfully updated']);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return response()->json(['message' => 'user deleted successfully']);
    }

    public function logOut()
    {

        auth()->logout();

        return redirect()->route('login')->with(['message' => 'user Logout Successfull']);
    }
}
