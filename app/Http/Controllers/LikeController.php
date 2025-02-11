<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function toggleLike($postId)
    {
        $post = Post::findOrFail($postId);
        $user = Auth::user();

        // Check if the user has already liked the post
        if ($user->likes->contains($post)) {
            // If the user has already liked the post, remove the like
            $user->likes()->detach($post);
        } else {
            // Otherwise, add a like
            $user->likes()->attach($post);
        }

        return back(); // Redirect back to the previous page (or wherever you'd like)
    }
}
