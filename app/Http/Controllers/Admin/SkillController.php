<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AboutSkill;
use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $page = $request->page;
        $pager = 5;
        $skill = Skill::paginate($pager, ['id', 'skill_name', 'skill_percentage'], 'p~', $page);

        return response()->json([
            'items'        =>  $skill->items(),
            'total'       =>  $skill->total(),
            'current_page' =>  $skill->currentPage(),
            'last_page'    =>  $skill->lastPage(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('admin.about.skill');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AboutSkill $request)
    {

        try {
            $skill = new Skill();
            $skill->skill_name       = $request->name;
            $skill->skill_percentage = $request->skill_percentage;
            $skill->save();
            return response()->json(['status' => true, 'message' => 'Skill data successfully added']);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => 'Some thing went wrong', 'error' => $th->getMessage()]);
        }
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
