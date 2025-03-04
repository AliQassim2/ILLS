<?php

namespace App\Http\Controllers;

use App\Models\stories;
use App\Models\story_comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class StoryCommentController extends Controller
{
    public function index($stories)
    {
        // dd($stories);
        $comments = story_comment::where('stories_id', $stories)->latest('created_at')->get();
        return view('main.comments', ['comments' => $comments, 'story' => $stories]);
    }
    public function store($stories, Request $request)
    {
        $request->validate([
            'comment' => 'required',

        ]);
        $comment = new story_comment();
        $comment->body = $request->comment;
        $comment->stories_id = $stories;
        $comment->user_id = Auth::id();
        $comment->save();
        return redirect()->back();
    }
}
