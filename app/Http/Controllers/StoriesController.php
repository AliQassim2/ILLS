<?php

namespace App\Http\Controllers;

use App\Models\stories;
use App\Models\questions;

use Illuminate\Support\Facades\Auth;
use App\Models\result;
use App\Http\Requests\StorestoriesRequest;
use App\Http\Requests\UpdatestoriesRequest;
use Illuminate\Http\Request;

class StoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = stories::with('user');
        if (request()->status == 'Rating')
            $query = $query->withSum('story_like as likes', 'like')->orderBy('likes', 'desc');
        else if (request()->status == 'Most Viewed')
            $query = $query->orderBy('views', 'desc');
        elseif (request()->search)
            $query = $query->where('title', 'like', '%' . request()->search . '%')->orderBy('created_at', 'DESC');
        else
            $query = $query->orderBy('created_at', 'DESC');

        $stories = $query->where('is_active', true)->simplePaginate(6);
        return view('main.stories', compact('stories'));
    }

    // Make sure this is imported

    public function show(stories $stories)
    {
        $story = $stories->with('user')->findOrFail($stories->id);
        $story->increment('views');

        $questions = questions::where('stories_id', $story->id)->get();

        $userScore = null;

        if (Auth::check()) {
            $userScore = result::where('user_id', Auth::id())
                ->where('stories_id', $story->id)
                ->value('score'); // or ->first() if you need more info
        }

        return view('main.story', compact('story', 'questions', 'userScore'));
    }
}
