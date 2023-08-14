<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Tag $tag)
    {
        return view("dashboard.tag.index", ["data" => $tag::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("dashboard.tag.new");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Tag $tag)
    {
        $validation = $request->validate([
            "title" => "required",
            "slug" => "required"
        ]);

        $tag->create([
            "title" => $request->input("title"),
            "slug" => $request->input("slug")
        ]);

        return redirect()->route("tags.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view("dashboard.tag.detail", [
            "id" => $id,
            "data" => Tag::find($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view("dashboard.tag.edit", [
            "id" => $id,
            "data" => Tag::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validation = $request->validate([
            "title" => "required",
            "slug" => "required"
        ]);

        $tag = Tag::find($id);
        $tag->title = $request->input("title");
        $tag->slug = $request->input("slug");

        $tag->save();

        return redirect()->route("tags.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Tag::destroy($id);
        return redirect()->back();
    }
}
