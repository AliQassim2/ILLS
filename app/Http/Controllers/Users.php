<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
use App\Mail\verified;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class Users extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = User::where('role', 1)->whereNotNull('email_verified_at')->where('is_banned', '!=', 2);
        if (request()->sort == 'stories') {
            $query = $query->withCount(['result as stories_count' => function ($subquery) {
                $subquery->select(DB::raw('count(stories_id)'));
            }])->orderBy('stories_count', 'DESC');
        } else {
            $query = $query->addSelect([
                'total_score' => function ($subquery) {
                    $subquery->selectRaw('SUM(score)')
                        ->from('results')
                        ->whereColumn('results.user_id', 'users.id');
                }
            ])->orderBy('total_score', 'DESC');
        }
        $users = $query->simplePaginate(20);
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
        $validated = request()->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        $validated['password'] = bcrypt($validated['password']);
        $user = User::create($validated);
        Auth::login($user);
        // Generate key and store in session
        $key = Str::random(6); // or use digits with `Str::random(6)`
        session(['email_verification_key' => $key]);
        session(['email_verification_user' => $user->id]);
        // Send the email with the key
        Mail::to($user->email)->send(new verified($key));
        $request->session()->regenerate();

        return redirect('/verify-email');
    }
    public function resendVerification()
    {
        $user = Auth::user();
        // Generate key and store in session
        $key = Str::random(6); // or use digits with `Str::random(6)`
        session(['email_verification_key' => $key]);
        session(['email_verification_user' => $user->id]);
        // Send the email with the key
        Mail::to($user->email)->send(new verified($key));

        return back()->with('success', 'Verification email resent.');
    }


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
        if (Auth::user()->is_banned ==  2) {
            Auth::logout();
            throw ValidationException::withMessages(['unAuth' => 'Sorry, your account has been banned.']);
        }
        $request->session()->regenerate();

        // Redirect to the intended page or fallback to the previous URL
        return redirect(route('home'));
    }


    public function update(User $user)
    {
        $validation = request()->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
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
        return redirect(route('login'));
    }
    public function users()
    {
        $users = User::where('role', '!=', 0)->paginate(10);
        return view('dashboard.dashboard', compact('users'));
    }

    public function upgrade($id)
    {
        $user = User::findOrFail($id);
        $user->role = 2;
        $user->save();
        return back()->with('success', 'User upgraded to publisher.');
    }

    public function toggleBan($id)
    {
        $user = User::findOrFail($id);
        $user->is_banned = !$user->is_banned;
        $user->save();
        return back()->with('success', 'User ban status updated.');
    }
    public function downgrade($id)
    {
        $user = User::findOrFail($id);
        $user->role = 1; // downgrade to normal user
        $user->save();

        return back()->with('success', $user->name . ' is now a regular user.');
    }


    public function showVerificationPage()
    {
        return view('main.verify');
    }

    public function processVerification(Request $request)
    {
        $request->validate([
            'key' => 'required|string',
        ]);

        if ($request->input('key') === session('email_verification_key')) {
            $user = User::find(session('email_verification_user'));
            $user->email_verified_at = now();
            $user->save();

            // Clear session
            session()->forget(['email_verification_key', 'email_verification_user']);

            return redirect('/')->with('success', 'Email verified!');
        }

        return back()->withErrors(['key' => 'Invalid verification code.']);
    }
}
