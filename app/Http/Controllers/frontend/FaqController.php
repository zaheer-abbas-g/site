<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\FaqRequest;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $page = $request->page;
        $pager = 5;
        $skill = Faq::orderBy('id', 'desc')->paginate($pager, ['id', 'question', 'answer', 'status'], 'p~', $page);

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
        return view('admin.faq.faq');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FaqRequest $request)
    {
        // dd($request->all());
        // return response()->json(['status' => true, 'message' => 'Faq data successfully added']);

        try {
            $faq = new Faq();
            $faq->question       = $request->question;
            $faq->answer = $request->answer;
            $faq->status = $request->status == 1 ? 'active' : 'inactive';
            $faq->save();
            return response()->json(['status' => true, 'message' => 'Faq data successfully added']);
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

    // app/Http/Controllers/YourController.php
    public function updateStatus(Request $request, $id)
    {
        // $validated = $request->validate([
        //     'status' => 'required|in:active,inactive'
        // ]);

        $faq = Faq::findOrFail($id);
        $faq->status = $request->status;
        $faq->save();
        return response()->json([
            'success' => true,
            'new_status' => $faq->status,
            'id' => $faq->id
        ]);
    }
}
