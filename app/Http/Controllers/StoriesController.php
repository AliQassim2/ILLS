<?php

namespace App\Http\Controllers;

use App\Models\stories;
use App\Models\questions;

use Illuminate\Support\Facades\Auth;
use App\Models\result;
use App\Http\Requests\StorestoriesRequest;
use App\Http\Requests\UpdatestoriesRequest;

class StoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stories = stories::with('user')
            ->withCount('likedStoryLikes as like_count') // alias like_count
            ->orderBy('like_count', 'DESC')
            ->simplePaginate(6);

        return view('main.stories', compact('stories'));
    }

    // Make sure this is imported

    public function show(stories $stories)
    {
        $story = $stories->with('user')->findOrFail($stories->id);
        $story->increment('views');

        $qustions = questions::where('stories_id', $story->id)->get();

        $userScore = null;

        if (Auth::check()) {
            $userScore = result::where('user_id', Auth::id())
                ->where('stories_id', $story->id)
                ->value('score'); // or ->first() if you need more info
        }

        return view('main.story', compact('story', 'qustions', 'userScore'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorestoriesRequest $request)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(stories $stories)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatestoriesRequest $request, stories $stories)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(stories $stories)
    {
        //
    }

    public function quiz($id)
    {
        $story = stories::with('questions')->findOrFail($id);
        return view('main.quiz', compact('story'));
    }
}
