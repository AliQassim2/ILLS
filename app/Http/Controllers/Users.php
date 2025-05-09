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
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\PasswordReset;

class Users extends Controller
{
    //ranks
    public function index()
    {
        $query = User::where('role', 1)
            ->whereNotNull('email_verified_at')
            ->where('is_banned', '!=', 2);

        if (request()->sort == 'stories') {
            $storiesSub = DB::table('results')
                ->select('user_id', DB::raw('COUNT(stories_id) as stories_count'))
                ->groupBy('user_id');

            $query = $query
                ->joinSub($storiesSub, 'user_stories', function ($join) {
                    $join->on('users.id', '=', 'user_stories.user_id');
                })
                ->orderByDesc('user_stories.stories_count')
                ->addSelect('users.*', 'user_stories.stories_count');
        } else {
            // Create a subquery for user scores
            $scoreSub = DB::table('results')
                ->select('user_id', DB::raw('SUM(score) as total_score'))
                ->groupBy('user_id');

            // Join the subquery to the users table
            $query = $query
                ->joinSub($scoreSub, 'user_scores', function ($join) {
                    $join->on('users.id', '=', 'user_scores.user_id');
                })
                ->orderByDesc('user_scores.total_score')
                ->addSelect('users.*', 'user_scores.total_score as score');
        }

        $users = $query->simplePaginate(20);

        return view('main.rank', ['users' => $users]);
    }


    //singup
    public function create()
    {
        return view('main.signup');
    }
    public function store(Request $request)
    {
        $validated = request()->validate([
            'name' => ['required', 'string', 'max:255', 'unique:users,name'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        if (trim(strtolower(request('name'))) ==  'admin') {
            throw ValidationException::withMessages(['name' => 'Sorry, this name is not allowed.']);
        }
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




    ///verification
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

    ///login
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

    ///profile
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
    public function update(User $user)
    {
        $validation = request()->validate([
            'name' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ]);
        if (User::where('name', $validation['name'])->where('id', '!=', $user->id)->exists()) {
            throw ValidationException::withMessages(['name' => 'Sorry, this name is already taken.']);
        }
        if (trim(strtolower(request('name'))) ==  'admin') {
            throw ValidationException::withMessages(['name' => 'Sorry, this name is not allowed.']);
        }
        $user->update($validation);
        return redirect(route('profile'))->with('success', 'Profile updated successfully.');
    }


    //logout
    public function logout()
    {
        Auth::logout();
        return redirect(route('login'));
    }





    ///forget password
    public function viewForgetPassword()
    {
        return view('main.forgetPassword');
    }
    public function sendLinks(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        if ($request->email == 'admin@admin') {
            return back()->withErrors(['email' => 'The email address for admin.']);
        }
        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['message' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }
    public function viewResetPassword(Request $request, $token)
    {
        return view('main.resetPassword', [
            'token' => $token,
            'email' => $request->email
        ]);
    }
    public function ResetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);
        if ($request->email == 'admin@admin') {
            return back()->withErrors(['email' => 'The email address for admin.']);
        }

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->save();

                event(new PasswordReset($user));
            }
        );
        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('message', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }
}
