<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TestimonialsRequest;
use App\Models\Testimonials;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $currentPage = $request->currentPage;
        $perpage = 5;
        $team = Testimonials::orderBy('id', 'desc')->paginate($perpage, ['*'], 'p~', $currentPage);

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
        return view('admin.about.testimonials');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TestimonialsRequest $request)
    {
        $testimonials = new Testimonials();
        $testimonials->name        = $request->name;
        $testimonials->designation = $request->designation;
        $testimonials->long_description = $request->long_description;

        if ($request->hasFile('image')) {
            $imageName = $request->file('image');
            $image = time() . '.' . $imageName->extension();
            $imageName->move(public_path('admin/upload/testimonials'), $image);
            $testimonials->image       = $image;
        } else {
            $testimonials->image       = '';
        }
        $testimonials->save();
        return response()->json(['success' => true, 'message' => 'Testimonials saved successfully', 'data' => $testimonials], 201);
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
            $team = Testimonials::findOrFail($id);
            return response()->json([
                'success' => true,
                'data' => $team,
                'message' => 'Testimonials retrieved successfully',
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Testimonials not found'
            ], 404);
        } catch (Exception $ex) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve Testimonials',
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TestimonialsRequest $request, string $id)
    {
        $testimonials =  Testimonials::find($id);
        $testimonials->name = $request->name;
        $testimonials->designation = $request->designation;
        $testimonials->long_description = $request->long_description;
        if ($request->hasFile('image')) {
            if (!empty($team->image)) {
                $imagePath = public_path('admin/upload/team/');
                $image_exist =  $imagePath . $testimonials->image;
                if (file_exists($image_exist)) {
                    unlink($image_exist);
                }
            }
            $image = $request->image;
            $originalName = $image->getClientOriginalName();
            $imageName = $originalName . '_' . time() . '.' . $image->extension();
            $image->move(public_path('admin/upload/testimonials/'), $imageName);
            $testimonials->image = $imageName;
        }
        $testimonials->save();
        return response()->json(['message' => 'Testimonials updated successfully', 'data' => $testimonials]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $testimonials = Testimonials::findOrFail($id);
            if (!empty($testimonials->image)) {
                $filePath = public_path('admin/upload/testimonials/') . $testimonials->image;
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }
            $testimonials->delete();
            return response()->json(['status' => true, 'data' => $testimonials, 'message' => 'Testimonials Successfully deleted'], 200);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'error' => $th->getMessage()], 404);
        }
    }
}
