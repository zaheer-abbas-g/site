<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AboutClient;
use App\Models\About;
use App\Models\Client;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $currentPage = $request->currentPage;
        $perpage = 5;
        $team = Client::orderBy('id', 'desc')->paginate($perpage, ['*'], 'p~', $currentPage);

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
        return view('admin.about.clients');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AboutClient $request)
    {
        $aboutclient = new Client();
        $aboutclient->client_name        = $request->name;

        if ($request->hasFile('image')) {
            $imageName = $request->file('image');
            $image = time() . '.' . $imageName->extension();
            $imageName->move(public_path('admin/upload/client'), $image);
            $aboutclient->client_logo       = $image;
        } else {
            $aboutclient->client_logo       = '';
        }
        $aboutclient->save();
        return response()->json(['success' => true, 'message' => 'Client added successfully', 'data' => $aboutclient], 201);
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
            $Client = Client::findOrFail($id);
            return response()->json([
                'success' => true,
                'data' => $Client,
                'message' => 'Client retrieved successfully',
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Client not found'
            ], 404);
        } catch (Exception $ex) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve Client',
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AboutClient $request, string $id)
    {


        $client =  Client::find($id);
        $client->client_name = $request->name;
        if ($request->hasFile('image')) {
            if (!empty($client->client_logo)) {
                $imagePath = public_path('admin/upload/client/');
                $image_exist =  $imagePath . $client->client_logo;
                if (file_exists($image_exist)) {
                    unlink($image_exist);
                }
            }
            $image = $request->image;
            $originalName = $image->getClientOriginalName();
            $imageName = $originalName . '_' . time() . '.' . $image->extension();
            $image->move(public_path('admin/upload/client/'), $imageName);
            $client->client_logo = $imageName;
        }

        $client->save();
        return response()->json(['message' => 'Client updated successfully', 'data' => $client]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        try {
            $client = Client::findOrFail($id);
            if (!empty($client->client_logo)) {
                $filePath = public_path('admin/upload/client/') . $client->client_logo;
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }
            $client->delete();
            return response()->json(['status' => true, 'data' => $client, 'message' => 'Data Successfully deleted'], 200);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'error' => $th->getMessage()], 404);
        }
    }
}
