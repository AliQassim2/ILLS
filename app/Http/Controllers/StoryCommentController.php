<?php

namespace App\Http\Controllers;

use App\Models\stories;
use App\Models\story_comment;
use Illuminate\Http\Request;

class StoryCommentController extends Controller
{
    public function index($stories)
    {
        // dd($stories);
        $comments = story_comment::where('stories_id', $stories)->get();
        return view('main.comments', ['comments' => $comments, 'story' => $stories]);
    }
}
