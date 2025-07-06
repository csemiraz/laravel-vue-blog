<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->get();
        return response()->json([
            'status' => true,
            'message' => 'Category retrived successfully',
            'data' => $categories
        ], 200);
    }

    public function store(Request $request)
    {
        //return response()->json($request);
        $request->validate([
            'category_name' => 'required|unique:categories'
        ]);

        $category = new Category();

        $category->category_name = $request->category_name;
        $category->save();

        return response()->json([
            'status' => true,
            'message' => 'Category info created successfully',
            'data' => $category
        ], 201);
    }

    public function show($id) {
        $category = Category::find($id);

        return response()->json([
            'status' => true,
            'message' =>  'Category info found successfully',
            'data' => $category
        ], 200);
    }

    public function update(Request $request, $id) {
        $request->validate([
            'category_name' => 'unique:categories,category_name,'.$id
        ]);

        $category = Category::find($id);
        //return $category;
        $category->category_name = $request->category_name;
        $category->update();

        return response()->json([
            'status' => true,
            'message' => 'Category info updated successfully',
            'data' => $category
        ], 200);
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();

        return response()->json([
            'status' =>  true,
            'message' => 'Category info deleted successfully',
        ], 202);
    }


}
