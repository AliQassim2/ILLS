<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\story_like as Like;

class StoryLikeController extends Controller
{
    public function toggleLike($stories)
    {
        // dd($stories);
        // Validate incoming request
        request()->validate([
            'stories_id' => 'required|exists:stories,id',
            'like' => 'required|integer|in:-1,0,1',
        ]);

        // Get authenticated user
        $userId = Auth::id(); // Instead of getting from request
        $storyId = $stories;
        $likeValue = request()->like;

        if (!$userId) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }

        // Check if the like/dislike already exists
        $like = Like::where('user_id', $userId)
            ->where('stories_id', $storyId)
            ->first();

        if ($like) {
            // If clicking the same button, remove like/dislike
            if ($like->like == $likeValue) {
                $like->delete();
            } else {
                $like->update(['like' => $likeValue]);
            }
        } else {
            Like::create([
                'user_id' => $userId,
                'stories_id' => $storyId,
                'like' => $likeValue
            ]);
        }

        // Get updated like/dislike counts
        $likesCount = Like::where('stories_id', $storyId)->where('like', 1)->count();
        $dislikesCount = Like::where('stories_id', $storyId)->where('like', -1)->count();

        return response()->json([
            'likes' => $likesCount,
            'dislikes' => $dislikesCount
        ]);
    }
}
