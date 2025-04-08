<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;


use function Laravel\Prompts\error;

class Users extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->sort == 'stories') {
            $users = User::withCount(['result as stories_count' => function ($query) {
                $query->select(DB::raw('count(stories_id)'));
            }])->orderBy('stories_count', 'DESC')->simplePaginate(20);
        } else {
            $users = User::withsum('result as score', 'score')->orderBy('score', 'DESC')->simplePaginate(20);
        }
        return view('main.rank', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('main.signup');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = request()->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone_number' => ['nullable', 'digits:11'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        $user = User::create($validation);
        Auth::login($user);
        return redirect('/');
    }

    /**
     * Display the specified resource.
     */
    public function show() {}

    public function display_login()
    {
        return view('main.login', ['redirect' => request('redirect')]);
    }

    public function login(Request $request)
    {
        $attributes = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (!Auth::attempt($attributes)) {
            throw ValidationException::withMessages(['unAuth' => 'Sorry, those credentials do not match.']);
        }

        $request->session()->regenerate();
        // dd($request->input('redirect'), url()->previous());

        // Redirect to the intended page or fallback to the previous URL
        return redirect($request->input('redirect', url('/')));
    }


    public function update(User $user)
    {
        $validation = request()->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone_number' => ['nullable', 'numeric', 'min:11'],
            'password' => ['required', 'string', 'min:8'],
        ]);
        $user->update($validation);
        return redirect('/');
    }
    public function reault($id)
    {
        return DB::table('results')->where('user_id', $id)->count();
    }
    public function sum($id)
    {
        return DB::table('results')->where('user_id', $id)->sum('score');
    }
    public function edit()
    {
        $totle_score = $this->sum(Auth::user()->id);
        $stories = $this->reault(Auth::user()->id);
        return view('main.profile', ['user' => Auth::user(), 'totle_score' => $totle_score, 'stories' => $stories]);
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
