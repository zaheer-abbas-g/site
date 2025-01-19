<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.about.about');
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
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'short_description' => 'required',
            'long_description' => 'required'
        ]);

        try {
            $about = new About();
            $about->about_title = $request->title;
            $about->about_short_description = $request->short_description;
            $about->about_long_description = $request->long_description;
            $about->save();

            return response()->json(['status' => true, 'message' => 'Data successfully added', 'data' => $about], 201);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'meesage' => "Data could not be inserted" . $th->getMessage()], 500);
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
