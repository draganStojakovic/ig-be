<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index', 'show']]);
    }

    public function index()
    {
        $term = request()->input('search');
        $userId = request()->input('user_id');
        if ($term) {
            if ($userId) {
                return Post::searchUserPosts($term, $userId);
            } else {
                return Post::search($term);
            }
        } else {
            return Post::with('user', 'likes')
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        }
    }

    public function show($id)
    {
        return Post::with('user', 'likes')->findOrFail($id);
    }

    public function store(StorePostRequest $request)
    {
        return Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'image_urls' => $request->image_urls,
            'user_id' => auth()->id(),
        ]);
    }

    public function update(StorePostRequest $request, $id)
    {
        $userId = auth()->id();
        $gallery = Post::findOrFail($id);
        if ($userId === $gallery->user_id) {
            $gallery->update($request->all());
            return $gallery;
        } else {
            return response()
                ->json(["error" => "Cannot update another user's post."]);
        }
    }

    public function destroy($id)
    {
        $userId = auth()->id();
        $post = Post::findOrFail($id);
        if ($post->user_id === $userId) {
            Post::destroy($id);
        } else {
            return response()
                ->json(["error" => "Cannot delete another user's post."]);
        }
    }
}
