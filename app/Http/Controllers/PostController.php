<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //,
        $posts = Post::all();
        return response(['posts'=>$posts], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'title' => ['required', 'max:255'],
            'excerpt'=>['required', 'string'],
            'body' => ['required', 'string'],
            'thumbnail'=>['image', 'max:2048']
        ]);

        $post = Post::create($attributes);

        return response ([
            'post' => $post,
            'message' => 'Post successfully created'
        ], 200);

    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return response([
            'post'=>$post
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
        $attributes = $request->validate([
            'title' => ['max:255'],
            'excerpt'=>['string'],
            'body' => ['string'],
            'thumbnail'=>['image', 'max:2048']
        ], 200);

        $post->update($attributes);

        return response([
            'post'=>$post,
            'message'=> 'post updated successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
    }
}