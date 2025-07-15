<?php

namespace App\Http\Controllers\API;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\FrontPostResource;

class FrontPostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->take(4)->get();
        return FrontPostResource::collection($posts);
    }

    public function singlePost($slug)
    {
        $post = Post::where('slug', $slug)->first();
        return new FrontPostResource($post);
    }

    public function relatedPost(Post $post)
    {
        $relatedPosts = Post::where('category_id', $post->category_id)->where('id', '!=', $post->id)->get();
    
        return FrontPostResource::collection($relatedPosts);
    }

    public function blogPost()
    {
        $blogPosts = Post::latest()->paginate(4)->withQueryString();

        return FrontPostResource::collection($blogPosts);
    }
}
