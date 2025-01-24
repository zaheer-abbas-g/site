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
        $about = About::select('id', 'about_title', 'about_short_description', 'about_long_description')->orderBy('id')->get();
        return response()->json(['data' => $about]);
    }

    /**
     * Show the form for creating a new resource.
     * @author zaheer
     */
    public function create()
    {
        return view('admin.about.index');
    }

    /**
     * Store a newly created resource in storage.
     * @param $request
     * @author zaheer
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
    public function edit(int $id)
    {
        $about['about_data'] =  About::find($id);
        $about['about_id'] =  encrypt($about['about_data']['id']);
        return response()->json($about);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $about_id =  decrypt($id);
        $about = About::find($about_id);
        $about->about_title = $request->title;
        $about->about_short_description = $request->short_description;
        $about->about_long_description = $request->short_description;
        $about->save();
        return response()->json(['status' => true, 'message' => 'About data updated successfully', 'data' => $about], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $about = About::find($id);
        $about->delete();

        if (!$about) {
            return response()->json(['status' => false, 'message' => 'Record not Found!'], 404);
        }
        return response()->json(['status' => true, 'message' => 'About data deleted successfully'], 200);
    }
}
