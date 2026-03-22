<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return Category::all();
    }

    public function show($id)
    {
        return Category::find($id);
    }

    public function store(Request $request)
    {
        $category = new Category();
        $category->name = $request->name;
        $category->save();

        return response()->json($category, 201);
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        $category->name = $request->name;
        $category->save();

        return response()->json($category, 200);
    }

    public function destroy($id)
    {
        Category::destroy($id);
        return response()->json(null, 204);
    }

    public function getProducts($categoryId)
    {
        $category = Category::find($categoryId);
        return $category ? $category->products : response()->json([], 404);
    }
}