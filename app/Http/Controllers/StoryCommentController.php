<?php

namespace App\Http\Controllers;

use App\Models\stories;
use App\Models\story_comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class StoryCommentController extends Controller
{
    use AuthorizesRequests;
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
        $comment->updated_at = null;
        $comment->save();
        return redirect()->back();
    }
    public function edit(story_comment $comment)
    {



        return view('main.editcomment', ['comment' => $comment]);
    }
    public function update($comment_id, Request $request)
    {
        // Retrieve the comment instance first.
        $comment = story_comment::findOrFail($comment_id);

        // Now authorize against the retrieved instance.

        $request->validate([
            'comment' => 'required',
        ]);

        $comment->body = $request->comment;
        $comment->updated_at = now();
        $comment->save();

        return redirect()->route('comment.index', ['story_id' => $comment->stories_id]);
    }

    public function destroy($comment_id)
    {
        $comment = story_comment::findOrFail($comment_id);
        $comment->delete();
        return redirect()->back();
    }
}
