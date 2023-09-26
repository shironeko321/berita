<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function store(Request $request)
    {
        $user = Auth::user();

        $article = Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'content_meta' => $request->content_meta,
            'status_published' => 1,
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
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $article = Post::find($id);
        $user = Auth::user();

        $article->update([
            'title' => $request->title,
            'content' => $request->content,
            'content_meta' => $request->content_meta,
            'status_published' => 1,
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

        $article->tags()->detach();
        $article->categorys()->detach();

        return redirect()->back();
    }
}
