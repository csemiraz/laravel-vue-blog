<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\FrontPostResource;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class FilterPostController extends Controller
{
    public function postByCategory(Category $category)
    {
        $posts = Post::where('category_id', $category->id)->get();
        return FrontPostResource::collection($posts);
    }

    public function search(Request $request)
    {
        if($request->search) {
            $posts = Post::where('title', 'like', '%' . $request->search . '%')->orWhere('description', 'like', '%' . $request->search . '%')->latest()->get();
            return FrontPostResource::collection($posts);
        }
    }
}
