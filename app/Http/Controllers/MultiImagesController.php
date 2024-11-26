<?php

namespace App\Http\Controllers;

use App\Models\MultiImages;
use Illuminate\Http\Request;
use DataTables;

class MultiImagesController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $multipleImages = MultiImages::select('id', 'image')->latest()->get();
            return DataTables::of($multipleImages)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editiamges"><i class="fa fa-pencil-square" aria-hidden="true"></i></a>';
                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteiamges"><i class="fa fa-trash-o" aria-hidden="true"></i></a>';
                    return $btn;
                })
                ->addColumn('image', function ($row) {
                    $image = '<img src="' . asset('admin/images/multipleImages/' . $row->image) . '"  alt="no image found" style="width: 100px; height: 100px; object-fit: cover;" class="rounded mx-auto d-block" >';
                    return $image;
                })
                ->rawColumns(['action', 'image'])
                ->make(true);
        }
        return view('admin.multipleimages');
    }

    public function store(Request $request)
    {
        $request->validate([
            'multipleImages.*' => 'required|mimes:png,jpg,jpeg'
        ]);

        $multipleImages = new MultiImages();
        if ($request->hasFile('multipleImages')) {
            $images = $request->multipleImages;
            $data = [];
            foreach ($images as $key => $image) {
                $iamgeName  =  uniqid() . '_' . time() . '.' . $image->extension();
                $image->move('admin/images/multipleImages', $iamgeName);
                $data[]['image'] = $iamgeName;
            }
            foreach ($data as $key => $values) {
                $multipleImages::create($values);
            }
            return response()->json(['success' => true, 'message' => 'Multiple images are successfully inserted']);
        }
    }

    public function edit($id)
    {

        $multimages = MultiImages::findOrFail($id);
        return response()->json(['success' => true, 'data' => $multimages]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'image' => 'required|mimes:png,jpg,jpeg'
        ]);
        if ($request->hasFile('image')) {
            return response()->json('oddd');
        }
    }
}
