<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use App\Models\Comment;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['show']]);
    }

    public function show($id)
    {
        return User::with('posts', 'followers')->findOrFail($id);
    }

    public function setPublicTrue()
    {
        $user = User::findOrFail(auth()->id());
        if ($user->public !== 0) {
            return response()->json(["error" => "Account is already public."]);
        }
        $user->update(["public" => true]);
        return $user;
    }

    public function setPublicFalse()
    {
        $user = User::findOrFail(auth()->id());
        if ($user->public !== 1) {
            return response()->json(["error" => "Account is already hidden."]);
        }
        $user->update(["public" => false]);
        return $user;
    }

    public function follow()
    {
        $followerId = auth()->id();
        $followedId = request()->input('user_id');
        $user = User::with('followers')->findOrFail($followedId);
        if ($followerId && $followedId) {
            foreach ($user->followers as $follower) {
                if ($follower->pivot->follower_id === $followerId) {
                    return response()->json(["error" => "Already a follower."]);
                }
            }
            User::findOrFail($followerId)
                ->followings()
                ->attach(User::findOrFail($followedId));
        } else {
            return response()->json(["error" => "Missing params."]);
        }
    }

    public function unfollow()
    {
        $followerId = auth()->id();
        $followedId = request()->input('user_id');
        if ($followerId && $followedId) {
            $user = User::with('followers')->findOrFail($followedId);
            foreach ($user->followers as $follower) {
                if ($follower->pivot->follower_id === $followerId) {
                    User::findOrFail($followerId)
                        ->followings()
                        ->detach($user);
                }
            }
        } else {
            return response()->json(["error" => "Missing params."]);
        }
    }

    public function likePost()
    {
        $postId = request()->input('post_id');
        $post = Post::with('likes')->findOrfail($postId);
        $user = User::findOrfail(auth()->id());
        if ($user && $postId && $post) {
            foreach ($post->likes as $likes) {
                if ($likes->pivot->user_id === $user->id) {
                    return response()
                        ->json(["error" => "Already liked a post."]);
                }
            }
            return $user->likedPosts()->attach(Post::findOrFail($postId));
        }
    }

    public function unlikePost()
    {
        $postId = request()->input('post_id');
        if ($postId) {
            $post = Post::with('likes')->findOrFail($postId);
            $user = User::findOrFail(auth()->id());
            foreach ($post->likes as $likes) {
                if ($likes->pivot->user_id === $user->id) {
                    $user->likedPosts()->detach(Post::findOrFail($postId));
                }
            }
        } else {
            return response()->json(["error" => "Missing params."]);
        }
    }

    public function likeComment()
    {
        $commentId = request()->input('comment_id');
        if (!$commentId) {
            return response()->json(["error" => "Missing params."]);
        }
        $user = User::findOrFail(auth()->id());
        if (!$user) {
            return response()->json(["error" => "Auth user missing"]);
        }
        $comment = Comment::with('likes')->findOrFail($commentId);
        foreach ($comment->likes as $likes) {
            if ($likes->pivot->user_id === $user->id) {
                return response()
                    ->json(["error" => "Already liked a comment."]);
            }
        }
        $user->likedComments()->attach($comment);
    }

    public function unlikeComment()
    {
        $commentId = request()->input('comment_id');
        if (!$commentId) {
            return response()->json(["error" => "Missing params."]);
        }
        $user = User::findOrFail(auth()->id());
        if (!$user) {
            return response()->json(["error" => "Auth user missing"]);
        }
        $comment = Comment::with('likes')->findOrFail($commentId);
        foreach ($comment->likes as $likes) {
            if ($likes->pivot->user_id === $user->id) {
                $user->likedComments()->detach($comment);
            }
        }
    }
}
