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
    public function index(Request $request)
    {

        $currentPage = $request->currentPage;
        $perpage = 10;
        $team = Team::paginate($perpage, ['*'], 'p~', $currentPage);

        return response()->json(
            [
                'success' => true,
                'data' => $team->items(),
                'total' => $team->total(),
                'current_page' => $team->currentPage(),
                'last_page' => $team->lastPage(),
            ],
            200
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.about.team');
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
            $imageName = $request->file('image');
            $image = time() . '.' . $imageName->extension();
            $imageName->move(public_path('admin/upload/team'), $image);
            $abouteam->image       = $image;
        } else {
            $abouteam->image       = '';
        }
        $abouteam->save();
        return response()->json(['success' => true, 'message' => 'Team member added successfully', 'data' => $abouteam], 201);
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
    public function edit(string $id) {}

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
