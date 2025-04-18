<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\stories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use App\Models\story_comment;
use App\Models\story_like;

class DashboardController extends Controller
{

    // Show all users
    public function users()
    {
        $users = User::where('role', '!=', 0)->paginate(10);
        return view('dashboard.users', compact('users')); // Now points to users.blade.php
    }

    // Upgrade user to publisher
    public function upgradeToPublisher($id)
    {
        $user = User::findOrFail($id);
        $user->role = 2; // publisher role
        $user->save();

        return back()->with('success', 'User upgraded to publisher.');
    }
    public function downgrade($id)
    {
        $user = User::findOrFail($id);
        $user->role = 1; // downgrade to normal user
        $user->save();

        return back()->with('success', $user->name . ' is now a regular user.');
    }
    // Ban or unban user
    public function toggleBan($id)
    {
        $user = User::findOrFail($id);
        if ($user->is_banned == 1) {
            $user->is_banned = 0;
        } else {
            $user->is_banned = 1;
            story_comment::where('user_id', $user->id)->delete();
            story_like::where('user_id', $user->id)->delete();
        }
        $user->save();

        return back()->with('success', 'User ban status changed.');
    }
    public function toggleFullBan($id)
    {
        $user = User::findOrFail($id);
        if ($user->is_banned == 2) {
            $user->is_banned = 0;
        } else {
            $user->is_banned = 2;
            story_comment::where('user_id', $user->id)->delete();
            story_like::where('user_id', $user->id)->delete();
        }
        $user->save();

        return back()->with('success', 'User ban status changed.');
    }
    // Show all stories with pagination
    public function stories()
    {

        $query = Stories::with('user')->orderBy('created_at', 'DESC');

        if (Auth::user()->role != 0) {
            $query->where('user_id', Auth::user()->id);
        }

        $stories = $query->paginate(10);
        return view('dashboard.stories', compact('stories'));
    }

    // Show create story form
    public function createStory()
    {
        return view('dashboard.story-create');
    }

    // Store new story
    public function storeStory(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'Author' => 'required|string|max:255',
            'description' => 'required|string',
            'body' => 'required|string',
            'Difficulty' => 'required|integer',

        ]);
        $request->is_active = $request->is_active ? 1 : 0; // Convert to boolean

        stories::create([
            'title' => $request->title,
            'Author' => $request->Author,
            'description' => $request->description,
            'body' => $request->body,
            'Difficulty' => $request->Difficulty,
            'is_active' => $request->is_active,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('dashboard.stories')->with('success', 'Story added successfully.');
    }

    // Show edit story form
    public function editStory($id)
    {
        $story = Stories::findOrFail($id);
        return view('dashboard.story-edit', compact('story'));
    }

    // Update story
    public function updateStory(Request $request, $id)
    {
        $story = Stories::findOrFail($id);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'Author' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'body' => ['required', 'string'],
            'Difficulty' => ['required', 'integer', 'between:1,3'],

        ]);

        $story->update([
            'title' => $validated['title'],
            'Author' => $validated['Author'],
            'description' => $validated['description'],
            'body' => $validated['body'],
            'Difficulty' => $validated['Difficulty'],


        ]);

        return redirect()->route('dashboard.stories')->with('success', 'Story updated successfully.');
    }

    // Delete story
    public function deleteStory(stories $id)
    {
        $id->delete();
        return redirect()->route('dashboard.stories')->with('success', 'Story deleted successfully');
    }

    // Toggle story status
    public function toggleStoryStatus($id)
    {
        $story = stories::findOrFail($id);
        $story->is_active = !$story->is_active;
        $story->save();

        return back()->with('success', 'Story status updated successfully.');
    }
    // Add these methods to your DashboardController
    public function storyQuestions($id)
    {
        $story = Stories::with('questions')->findOrFail($id);
        return view('dashboard.questions-index', compact('story'));
    }

    public function createQuestion($storyId)
    {
        $story = Stories::findOrFail($storyId);
        return view('dashboard.question-create', compact('story'));
    }

    public function storeQuestion(Request $request, $storyId)
    {
        $request->validate([
            'question' => 'required|string|max:255',
            'correct_answer' => 'required|string|max:255',
            'answer1' => 'required|string|max:255',
            'answer2' => 'required|string|max:255',
            'answer3' => 'required|string|max:255',
        ]);

        \App\Models\questions::create([
            'question' => $request->question,
            'correct_answer' => $request->correct_answer,
            'answer1' => $request->answer1,
            'answer2' => $request->answer2,
            'answer3' => $request->answer3,
            'stories_id' => $storyId,
        ]);

        return redirect()->route('dashboard.stories.questions.index', $storyId)
            ->with('success', 'Question added successfully');
    }

    public function editQuestion($id)
    {
        $question = \App\Models\questions::findOrFail($id);
        return view('dashboard.question-edit', compact('question'));
    }

    public function updateQuestion(Request $request, $id)
    {
        $question = \App\Models\questions::findOrFail($id);

        $request->validate([
            'question' => 'required|string|max:255',
            'correct_answer' => 'required|string|max:255',
            'answer1' => 'required|string|max:255',
            'answer2' => 'required|string|max:255',
            'answer3' => 'required|string|max:255',
        ]);

        $question->update($request->all());

        return redirect()->route('dashboard.stories.questions.index', $question->stories_id)
            ->with('success', 'Question updated successfully');
    }

    public function deleteQuestion($id)
    {
        $question = \App\Models\questions::findOrFail($id);
        $storyId = $question->stories_id;
        $question->delete();

        return redirect()->route('dashboard.stories.questions.index', $storyId)
            ->with('success', 'Question deleted successfully');
    }
    public function suggested($id)
    {
        $story = Stories::findOrFail($id);
        $story->suggested = !$story->suggested;
        $story->save();

        return back()->with('success', 'Story feature status updated successfully.');
    }
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->back()->with('success', 'User deleted successfully.');
    }
}
