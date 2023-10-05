<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Image;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $image = Media::select('id', 'media_name')->get();
        return view("dashboard.media.index", [
            "collection" => $image
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     "image" => "file|image",
        // ]);

        // $request->file('image')->store('images');

        // return redirect()->route("media.index");
        $this->validate($request, [
            'image' => 'required|image|mimes:jpeg,jpg,png|max:2048'
        ]);

        if ($request->hasFile('image')) {

            $imageName = time() . '-' . $request->file('image')->getClientOriginalName();
            $imagePath = 'images/' . $imageName;
            $destinationPath = public_path($imagePath);
            Image::make($request->file('image'))->save($destinationPath);

            Media::create([
                'media_name' => $imageName
            ]);
        }
        return redirect()->route("media.index");
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function uploadImageArticle(Request $request)
    {
        $this->validate($request, [
            'image' => 'required|image|mimes:jpeg,jpg,png|max:2048'
        ]);

        if ($request->hasFile('image')) {

            $imageName = time() . '-' . $request->file('image')->getClientOriginalName();
            $imagePath = 'images/' . $imageName;
            $destinationPath = public_path($imagePath);
            Image::make($request->file('image'))->save($destinationPath);

            Media::create([
                'media_name' => $imageName
            ]);
        }
        $url = $request->schemeAndHttpHost();
        return response()->json(['location'=> $url . "/images/" . $imageName]);
        // return;
    }
}
