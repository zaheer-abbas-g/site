<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use DataTables;
use Termwind\Components\Raw;

class BrandController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $brand = Brand::orderBy('id', 'desc')->get();
            return DataTables::of($brand)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editbrand"><i  class="mdi mdi-pencil-box" ></i></a>';

                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deletebrand"><i class="mdi mdi-trash-can" aria-hidden="true"></i></a>';

                    return $btn;
                })
                ->addColumn('brandimage', function ($row) {
                    $btn = '<img src="' . asset('admin/images/brand/' . $row->brand_image) . '" alt="" style="width: 100px; height: 100px; object-fit: cover;" class="rounded mx-auto d-block">';
                    return $btn;
                })
                ->rawColumns(['action', 'brandimage'])
                ->make(true);
        }
        return view('admin.brand');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'brandname' => 'required',
                'brandimage' => 'required|mimes:png,jpg,jpeg|between:1,1024'
            ],
            [
                'brandname.required' => 'The brand name field is required. Please fill it in.',
                'brandimage.required' => 'Please upload an image.',
                'brandimage.between' => 'The image size must be less then 1mb or equal 1mb',
            ]
        );

        $brand = new Brand();
        if ($request->hasFile('brandimage')) {
            $image = $request->brandimage;
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('admin/images/brand'), $imageName);
            $brand->brand_image = $imageName;
        }
        $brand->brand_name = $request->brandname;
        $brand->save();
        return response()->json(['success' => true, 'message' => 'Brand Successfully added']);
    }


    public function edit($id)
    {

        try {
            $brand = Brand::findOrFail($id);
            return response()->json(['success' => true, 'data' =>  $brand]);
        } catch (\Exception $e) {
            logger()->error('Brand not found' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Brand Not Found']);
        }
    }

    public function update(Request $request, $id)
    {

        $request->validate(
            [
                'brandname' => 'required',
                'brandimage' => 'required|mimes:png,jpg,jpeg|between:1,1024'
            ],
            [
                'brandname.required' => 'The brand name field is required. Please fill it in.',
                'brandimage.required' => 'Please upload an image.',
                'brandimage.between' => 'The image size must be less then 1mb or equal 1mb',
            ]
        );

        $brand = Brand::find($id);
        if ($request->hasFile('brandimage')) {

            ############ unlink existing image ############
            $brandImage = $brand->brand_image;
            $filePath = public_path('admin/images/brand/') . $brandImage;
            if (file_exists($filePath)) {
                unlink($filePath);
            }

            ############ Uploading New image ##########333333
            $image = $request->brandimage;
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('admin/images/brand'), $imageName);
            $brand->brand_image = $imageName;
        }
        $brand->brand_name = $request->brandname;
        $brand->update();
        return response()->json(['success' => true, 'data' => $brand,  'message' => 'brand Successfully updated']);
    }

    public function destroy($id)
    {


        try {
            $brand = Brand::findOrFail($id);

            $image = $brand->brand_image;
            $imagePath = public_path('admin/images/brand/') . $image;
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
            $brand->delete();
            return response()->json(['success' => true, 'data' => $brand, 'message' => 'Brand successfully deleted']);
        } catch (\Exception $e) {
            logger()->error('Brand Not Found' . $e->getMessage());
            return response()->json(['success' => true, 'message' => 'Brand not delete'], 500);
        }
    }
}
