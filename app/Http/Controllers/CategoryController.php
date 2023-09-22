<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Category $category)
    {
        return view("dashboard.category.index", ["data" => $category::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("dashboard.category.new");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request, Category $category)
    {
        $category->create([
            "title" => $request->input("title"),
        ]);

        return redirect()->route("category.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view("dashboard.category.detail", [
            "id" => $id,
            "data" => Category::find($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view("dashboard.category.edit", [
            "id" => $id,
            "data" => Category::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $id)
    {
        $category = Category::find($id);
        $category->title = $request->input("title");

        $category->save();

        return redirect()->route("category.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Category::destroy($id);
        return redirect()->back();
    }
}
