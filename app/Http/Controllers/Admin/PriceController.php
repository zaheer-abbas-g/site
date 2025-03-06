<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\MessageResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\PriceRequest;
use App\Models\PricePlan;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PriceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $page = $request->page;
        $pager = 5;
        $skill = PricePlan::orderBy('id', 'desc')->paginate($pager, ['*'], 'p~', $page);

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
        return view('admin.price.price');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PriceRequest $request)
    {
        try {
            $price = new PricePlan();
            $price->name       = $request->name;
            $price->price      = $request->Price;
            $price->duration   = $request->duration;
            $price->features   = $request->features;
            $price->save();
            return response()->json(['status' => true, 'message' => 'price data successfully added']);
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
            $price = PricePlan::FindOrFail($id);
            return MessageResponse::sendResponse('success', $price,  'Data is retrieving', 200);
        } catch (ModelNotFoundException $e) {
            return MessageResponse::sendError(false, 'Record not found', $e->getMessage(), 404);
        } catch (\Throwable $th) {
            return MessageResponse::sendError(false, 'An error occurred while retrieving the record.', $th->getMessage(), 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PriceRequest $request, string $id)
    {

        try {

            DB::beginTransaction();
            $price = PricePlan::findOrFail($id);
            $price->name     = $request->name;
            $price->price    = $request->Price;
            $price->duration = $request->duration;
            $price->features = $request->features;
            $price->save();
            DB::commit();
            return MessageResponse::sendResponse('success', $price, 'Data updated successfully', 200);
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
            $price = PricePlan::find($id);
            $price->delete();
            return MessageResponse::sendResponse(true, $price, 'Data Successfully Deleted', 200);
        } catch (\Throwable $th) {
            return MessageResponse::sendError(false, 'An error occured', $th->getMessage(), 500);
        }
    }
}
