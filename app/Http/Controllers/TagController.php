<?php

namespace App\Http\Controllers;

use App\Http\Requests\TagRequest;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tag = Tag::all();
        return view("dashboard.tag.index", compact("tag"));
    }

    public function store(TagRequest $request)
    {
        $user = Auth::user();
        Tag::create([
            "title" => $request->input("title"),
            'user_id' => $user->id,
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
    public function update(Request $request, string $id)
    {
        $user = Auth::user();
        Tag::findOrFail($id)->Update([
            "title"=> $request->input("title"),
            "user_id"=> $user->id,
        ]);

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
