<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AboutTeam;
use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('admin.about.team');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     * @author zaheer
     */
    public function store(AboutTeam $request)
    {

        $abouteam = new Team();
        $abouteam->about_team_description = $request->team_description;
        $abouteam->name        = $request->name;
        $abouteam->designation = $request->designation;

        if ($request->hasFile('image')) {

            $imageName = $request->image;
            $originalName = $imageName->getClientOriginalName();
            $image = time() . '.' . $imageName->extension();
            // $imageName->move(public_path('admin/upload/team'), $image);
            // $imageName->store(public_path('admin/upload/team'));
            $imageName->storeAs('admin/upload/team', $originalName);
            // echo $image;
            die;
        }
        $abouteam->image       = $request->image;
        return response()->json($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
