<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use Inertia\Inertia;
use App\Models\Post;
use App\Models\Category;

class PostController extends Controller
{
    public function index(Post $post)
    {
        return Inertia::render("Post/Index",["posts" => Post::with("category")->get()]);
    }
    
    public function show(Post $post)
    {
        return inertia("Post/Show", ["post" => $post->load('category')]);
    }
    
    public function create(Category $category)
    {
        return Inertia::render("Post/Create",["categories" => $category->get()]);
    }
    
    public function store(PostRequest $request, Post $post)
    {
        $input = $request->all();
        $post->fill($input)->save();
        return redirect("/posts/" . $post->id);
    }
    
    public function edit(Post $post)
    {
        return Inertia::render("Post/Edit", ["post" => $post]);
    }
        
    public function update(PostRequest $request, Post $post)
    {
        $input = $request->all();
        $post->fill($input)->save();
        return redirect("/posts/" . $post->id);
    }
    
    public function delete(Post $post){
        $post->delete();
        return redirect("/posts");
    }
}
