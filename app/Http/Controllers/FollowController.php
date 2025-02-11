<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use App\Models\User;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function follow(Request $request, $userId)
    {
        $user = User::findOrFail($userId);
        $request->user()->followees()->attach($user);

        return response()->json(['message' => 'Successfully followed.']);
    }

    public function unfollow(Request $request, $userId)
    {
        $user = User::findOrFail($userId);
        $request->user()->followees()->detach($user);

        return response()->json(['message' => 'Successfully unfollowed.']);
    }

    public function getFollowers($userId)
    {
        $user = User::findOrFail($userId);
        return response()->json($user->followers);
    }

    public function getFollowees($userId)
    {
        $user = User::findOrFail($userId);
        return response()->json($user->followees);
    }
}
