<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Log\Logger;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $categories = Category::with('user')->withTrashed()->get();
            return DataTables::of($categories)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editCategory"><i class="fa fa-pencil-square" aria-hidden="true"></i></a>';

                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteCategory"><i class="fa fa-trash-o" aria-hidden="true"></i></a>';



                    return $btn;
                })
                ->addColumn('trash', function ($row) {

                    if ($row->deleted_at) {
                        $btn =   ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm trashed">Trash</a>';
                        return  $btn =   $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-success btn-sm restore">Restore</a>';
                    }
                })
                ->rawColumns(['action', 'trash'])
                ->make(true);
        }


        return view('admin.category');
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|unique:categories|max:255',
        ], [
            'category_name.required' => 'Please input Category Name',
            'category_name.max' => 'Category less then 255 characters',
        ]);

        $user_id = auth()->id();
        $user = User::find($user_id);
        $category = new Category();
        $category->category_name = $request->category_name;
        $user->categories()->save($category);
        return response()->json(['success' => true, 'message' => 'Category successfully added']);
    }

    public function edit($id)
    {
        try {
            $category = Category::with('user')->findOrFail($id);
            return response()->json(['success' => true, 'data' => $category]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'category not found'], 404);
        }
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'category_name' => 'required|unique:categories|max:255',
        ], [
            'category_name.required' => 'Please input Category Name',
            'category_name.max' => 'Category less then 255 characters',
        ]);

        try {

            $user_id = auth()->id();
            $user = User::find($user_id);
            $category = Category::findOrFail($id);
            $category->category_name = $request->category_name;
            $user->categories()->save($category);

            return response()->json(['success' => true, 'data' => $category, 'message' => 'Category Successfull updated']);
        } catch (\Exception $e) {
            logger()->error('Category update failed: ' . $e->getMessage());

            return response()->json(['success' => false, 'message' => 'Category Not updated'], 500);
        }
    }


    public function destroy($id)
    {

        try {
            $category = Category::find($id);
            $category->delete();
            return response()->json(['success' => true, 'data' => $category, 'message' => 'Category Deleted Successfully']);
        } catch (\Exception $e) {
            Logger()->error('Category Not delete' . $e->getMessage());
            return response()->json(['success' => false,  'message' => 'Category Deleted Successfully'], 404);
        }
    }

    public function restore($id)
    {


        try {
            $category =  Category::onlyTrashed()->find($id);
            $category->restore();
            return response()->json(['success' => true, 'data' => $category, 'message' => 'Category restored']);
        } catch (\Exception $e) {
            logger()->error('Category restore failed' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Category restore failed'], 404);
        }
    }
}
