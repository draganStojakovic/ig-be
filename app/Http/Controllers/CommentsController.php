<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Http\Requests\StoreCommentRequest;

class CommentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index', 'show']]);
    }

    public function index()
    {
        $userId = request()->input('user_id');
        if ($userId) {
            return Comment::where("user_id", $userId)
                ->orderBy("created_at", "desc")
                ->get();
        } else {
            return Comment::all();
        }
    }

    public function show($id)
    {
        return Comment::with('likes')->findOrFail($id);
    }

    public function store(StoreCommentRequest $request)
    {
        $postId = request()->input('post_id');
        if ($postId) {
            return Comment::create([
                'content' => $request->content,
                'user_id' => auth()->id(),
                'post_id' => $postId,
            ]);
        } else {
            return response()->json(["error" => "post_id missing."]);
        }
    }

    public function update(StoreCommentRequest $request, $id)
    {
        $userId = auth()->id();
        $comment = Comment::findOrFail($id);
        if ($userId === $comment->user_id) {
            $comment->update($request->all());
            return $comment;
        } else {
            return response()
                ->json(["error" => "Cannot update another user's comment."]);
        }
    }

    public function destroy($id)
    {
        $userId = auth()->id();
        $comment = Comment::findOrFail($id);
        if ($userId === $comment->user_id) {
            Comment::destroy($id);
            return $comment;
        } else {
            return response()
                ->json(["error" => "Cannot delete another user's comment."]);
        }
    }
}
