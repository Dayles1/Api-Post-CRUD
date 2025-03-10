<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return response()->json([
            'status' => 200,
            'data' => $posts
        ]);
    }

    public function store(StorePostRequest $request)
    {
        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => $request->id,
        ]);

        return response()->json([
            'status' => 201,
            'data' => $post,
            'message' => 'Post created successfully'
        ], 201);
    }

    public function show(string $id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json([
                'status' => 404,
                'message' => 'Post not found'
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'data' => $post
        ]);
    }

    public function update(Request $request, string $id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json([
                'status' => 404,
                'message' => 'Post not found'
            ], 404);
        }

        $post->update([
            'title' => $request->title ?? $post->title,
            'content' => $request->content ?? $post->content,
        ]);

        return response()->json([
            'status' => 200,
            'data' => $post,
            'message' => 'Post updated successfully'
        ]);
    }

    public function destroy(string $id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json([
                'status' => 404,
                'message' => 'Post not found'
            ], 404);
        }

        $post->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Post deleted successfully'
        ]);
    }
}
