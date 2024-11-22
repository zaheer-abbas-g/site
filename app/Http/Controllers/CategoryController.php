<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use DataTables;
class CategoryController extends Controller
{
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $categories = Category::with('user')->get();
            return DataTables::of($categories)
                ->addIndexColumn()
                ->addColumn('username', function ($row) {
                    return $row->user ? $row->user->name : 'N/A';
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editCategory"><i class="fa fa-pencil-square" aria-hidden="true"></i></a>';

                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteCategory"><i class="fa fa-trash-o" aria-hidden="true"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        

        return view('admin.category');
    }

    public function store(Request $request)
    {
        $request->validate([
                'category_name' => 'required'
        ]);

        $user_id = auth()->id();
        $user = User::find($user_id);
        $category = new Category();
        $category->category_name = $request->category_name;
        $user->categories()->save($category);
        return response()->json(['message' => 'Category successfully added']);
    }

    public function edit($id)
    {   
        try {
            $category = Category::with('user')->findOrFail($id);
            return response()->json(['success' => true,'data' => $category ]);
        }
        catch(\Exception $e){
            return response()->json(['success' => false, 'message' => 'category not found'],404);
        }
    }

    public function update(Request $request, $id){

        $request->validate([
            'category_name' => 'required',
            'user_name' => 'required',
        ]);

        return response()->json($request);
    }


}
