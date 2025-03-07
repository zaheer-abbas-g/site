<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\MessageResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $page = $request->page;
        $pager = 5;
        $contact = Contact::orderBy('id', 'desc')->paginate($pager, ['*'], 'p~', $page);
        return response()->json([
            'items'        =>  $contact->items(),
            'total'        =>  $contact->total(),
            'current_page' =>  $contact->currentPage(),
            'last_page'    =>  $contact->lastPage(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.contact.contact');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ContactRequest $request)
    {
        try {
            $contact = new Contact();
            $contact->name       = $request->name;
            $contact->email      = $request->email;
            $contact->subject    = $request->subject;
            $contact->message    = $request->message;
            $contact->save();
            return MessageResponse::sendResponse(true, $contact, 'Contact data successfully added',  200);
        } catch (\Throwable $th) {
            return MessageResponse::sendError(false, 'An error occoured',  $th->getMessage(), 500);
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
            $contact = Contact::FindOrFail($id);
            return MessageResponse::sendResponse(true, $contact,  'Data is retrieving', 200);
        } catch (ModelNotFoundException $e) {
            return MessageResponse::sendError(false, 'Record not found', $e->getMessage(), 404);
        } catch (\Throwable $th) {
            return MessageResponse::sendError(false, 'An error occurred while retrieving the record.', $th->getMessage(), 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            DB::beginTransaction();
            $contact = Contact::findOrFail($id);
            $contact->name     = $request->name;
            $contact->email    = $request->email;
            $contact->subject = $request->subject;
            $contact->message = $request->message;
            $contact->save();
            DB::commit();
            return MessageResponse::sendResponse(true, $contact, 'Data updated successfully', 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return MessageResponse::sendError(false, 'An error occured', $th->getMessage(), 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $contact = Contact::find($id);
            $contact->delete();
            return MessageResponse::sendResponse(true, $contact, 'Data Successfully Deleted', 200);
        } catch (\Throwable $th) {
            return MessageResponse::sendError(false, 'An error occured', $th->getMessage(), 500);
        }
    }
}
