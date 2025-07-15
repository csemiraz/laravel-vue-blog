<?php

namespace App\Http\Controllers\API;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->where('user_id', Auth::id())->get();
        return response()->json([
            'status' => true,
            'message' => 'Posts retrived successfully.',
            'posts' => $posts
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'category_id' => 'required',
            'photo' => 'required|image|mimes:png,jpg,jpeg,gif',
            'description' => 'required',
        ]);

        /* Current Id generate */
        if(Post::count() == 0)
        {
            $postId = 1;
        }
        else {
            $postId = Post::latest()->first()->id + 1;
        }

        /* Photo Upload */ //post_0134645_1.jpg
        $ext = $request->file('photo')->extension();
        $imageName = 'posts_'.time().'_'.$postId.'.'.$ext;
        $request->file('photo')->move(public_path('images/'), $imageName);
        $imagePath = "/images/".$imageName;

        $post = new Post();
        $post->title = $request->title;
        $post->slug = Str::slug($request->title, '-').'-'.$postId;
        $post->category_id = $request->category_id;
        $post->photo = $imagePath;
        $post->description = $request->description;
        $post->user_id = Auth::id();
        $post->save();

        return response()->json([
            'status' => true,
            'message' => 'Post info created successfully',
        ], 201);
    }

    public function show($id)
    {
        $post = Post::where('id', $id)->where('user_id', Auth::id())->first();
        //$post = Post::find($id);

        if($post) {
            return response()->json([
                'status' => true,
                'message' => 'Single Post info retrived successfully',
                'data' => $post,
            ], 200);
        }
        else {
            return response()->json([
                'status' => false,
                'message' => 'Data Not Found!',
            ], 404);
        }
        
    }

    public function update(Request $request,  $id) 
    {
        $request->validate([
            'title' => 'required',
            'category_id' => 'required',
            'description' => 'required',
        ]);

         /* Current Id generate */
        if(Post::count() == 0)
        {
            $postId = 1;
        }
        else {
            $postId = Post::latest()->first()->id + 1;
        }

        $post = Post::find($id);
        if($request->file('photo')) {
            $request->validate([
                'photo' => 'image|mimes:png,jpg,jpeg,gif',
            ]);

            if(file_exists(public_path($post->photo))) {
                unlink(public_path($post->photo));
            }
            /* Photo Upload */ //post_0134645_1.jpg
            $ext = $request->file('photo')->extension();
            $imageName = 'posts_'.time().'_'.$postId.'.'.$ext;
            $request->file('photo')->move(public_path('images/'), $imageName);
            $imagePath = "/images/".$imageName;
            $post->photo = $imagePath;
        }
        
        $post->title = $request->title;
        $post->slug = Str::slug($request->title, '-').'-'.$postId;
        $post->category_id = $request->category_id;
        $post->description = $request->description;
        $post->user_id = Auth::id();
        $post->update();

        return response()->json([
            'status' => true,
            'message' => 'Post info updated successfully',
        ], 202);
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        if(file_exists(public_path($post->photo)))
        {
            unlink(public_path($post->photo));
        }

        return response()->json([
            'status' => true,
            'message' => 'Post info deleted successfully',
        ], 202);
    }


}
