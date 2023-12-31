<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Image;

class ArticleController extends Controller
{
    public function index(Post $post)
    {
        return view("dashboard.article.index", ["data" => $post::with('user')->get()]);
    }

    public function create()
    {
        return view("dashboard.article.new", [
            "category" => Category::select('id', 'title')->get(),
            "tag" => Tag::select('id', 'title')->get(),
        ]);
    }

    public function store(ArticleRequest $request)
    {
        $user = Auth::user();

        if ($request->hasFile('thumbnail')) {

            $imageName = time() . '-' . $request->file('thumbnail')->getClientOriginalName();
            $imagePath = 'thumbnail/' . $imageName;
            $destinationPath = public_path($imagePath);
            Image::make($request->file('thumbnail'))->resize(300, 200)->save($destinationPath);
        }

        $article = Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'content_meta' => $request->content_meta,
            'status_published' => $request->status_published,
            'thumbnail' => $imageName,
            'user_id' => $user->id
        ]);

        $article->tags()->attach($request->tags);
        $article->categorys()->attach($request->category);

        return redirect()->route('article.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $slug = Post::find($id)->with('user')->first()->slug;
        return redirect()->route("article.detail", ["slug" => $slug]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $article = Post::with(['tags', 'categorys'])->where('id', $id)->first();

        return view("dashboard.article.edit", [
            "article" => $article,
            'a_tag' => $article->tags->pluck('id')->toArray(),
            'a_category' => $article->categorys->pluck('id')->toArray(),
            "category" => Category::select('id', 'title')->get(),
            "tag" => Tag::select('id', 'title')->get(),
            "images" => Storage::allFiles("images")
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ArticleRequest $request, string $id)
    {
        $article = Post::find($id);
        $user = Auth::user();

        // dd($request->file('thumbnail'));

        $imagePath = 'thumbnail/' . $article->thumbnail;
        
        if ($request->hasFile('thumbnail')) {
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }

            $imageName = time() . '-' . $request->file('thumbnail')->getClientOriginalName();
            $imagePath = 'thumbnail/' . $imageName;
            $destinationPath = public_path($imagePath);
            Image::make($request->file('thumbnail'))->resize(300, 200)->save($destinationPath);
        } else {
            $imageName = $article->thumbnail;
        }

        $article->update([
            'title' => $request->title,
            'content' => $request->content,
            'content_meta' => $request->content_meta,
            'status_published' => $request->status_published,
            'thumbnail' => $imageName,
            'user_id' => $user->id
        ]);

        $article->tags()->sync($request->tags);
        $article->categorys()->sync($request->category);

        return redirect()->route('article.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $article = Post::find($id);

        Post::destroy($id);

        $imagePath = 'thumbnail/' . $article->thumbnail;
        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }

        $article->tags()->detach();
        $article->categorys()->detach();

        return redirect()->back();
    }

    public function updateView(string $id)
    {
        $article = Post::find($id);

        if (is_null($article->view_content)) {
            $countView = 1;
        } else {
            $countView = $article->view_content + 1;
        }

        $article->update([
            'view_content' => $countView
        ]);

        return response()->json();
    }
}
