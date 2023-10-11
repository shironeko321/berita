<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view("home.home", [
            "article" => Post::where("status_published", 1)->with('user')->get()
        ]);
    }
    public function article()
    {
        return view("home.article", [
            "article" => Post::where("status_published", 1)->get()
        ]);
    }
    public function detailArticle(string $slug)
    {
        $post = Post::where("slug", $slug)->with(['user', 'categorys', 'tags'])->first();
        $categoryArray = $post->categorys->pluck('slug')->toArray();
        $category = Category::select('slug')->get();
        

        // dd($categoryArray);

        return view("home.detailarticle", [
            "article" => $post,
            'categoryArray' => $categoryArray,
            'category' => $category
        ]);
    }
    public function category()
    {
        return view("home.category", [
            "category" => Category::all()
        ]);
    }
    public function detailCategory(string $slug)
    {
        return view("home.detailcategory", [
            "article" => Category::where("slug", $slug)->with("posts")->first()
        ]);
    }
    public function tags()
    {
        return view("home.tags", [
            "tags" => Tag::all()
        ]);
    }
    public function detailTags(string $slug)
    {
        return view("home.detailTags", [
            "article" => Tag::where("slug", $slug)->with("posts")->first()
        ]);
    }
}
