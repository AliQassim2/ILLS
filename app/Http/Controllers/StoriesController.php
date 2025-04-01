<?php

namespace App\Http\Controllers;

use App\Models\stories;
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
            ->withSum('story_like as like_count', 'like')
            ->orderBy('like_count', 'DESC') // Order by most likes
            ->simplePaginate(6);
        return view('main.stories', compact('stories'));
    }

    /**
     * Display the specified resource.
     */
    public function show(stories $stories)
    {
        $story = $stories->with('user')->findOrFail($stories->id);
        $story->increment('views');
        return view('main.story', compact('story'));
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
