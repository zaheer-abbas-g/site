<?php

namespace App\Http\Controllers\frontend;

use App\Helpers\MessageResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\FaqRequest;
use App\Models\Faq;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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
        try {
            $faqedit = Faq::FindOrFail($id);
            return MessageResponse::sendResponse('success', $faqedit,  'Data is retrieving', 200);
        } catch (ModelNotFoundException $e) {
            return MessageResponse::sendError(false, 'Record not found', $e->getMessage(), 404);
        } catch (\Throwable $th) {
            return MessageResponse::sendError(false, 'An error occurred while retrieving the record.', $th->getMessage(), 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FaqRequest $request, string $id)
    {
        try {
            $faq = Faq::find($id);
            $faq->question       = $request->question;
            $faq->answer = $request->answer;
            $faq->status = ($request->status == '1' ? 'active' : 'inactive');
            $faq->save();
            return MessageResponse::sendResponse(true, $faq, 'Faq data  updated successfully', 200);
        } catch (\Throwable $th) {
            return MessageResponse::sendError(false, 'An error occurred while retrieving the record.', $th->getMessage(), 500);
        }
    }


    public function updateStatus(Request $request, $id)
    {

        $faq = Faq::findOrFail($id);
        $faq->status = $request->status;
        $faq->save();
        return response()->json([
            'success' => true,
            'new_status' => $faq->status,
            'id' => $faq->id
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $faq = Faq::findOrFail($id);
            $faq->delete();
            return MessageResponse::sendResponse(true, $faq, 'Data Successfully deleted', 200);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'error' => $th->getMessage()], 404);
            return MessageResponse::sendError(false, 'An error occurred while retrieving the record.', $th->getMessage(), 500);
        }
    }
}
