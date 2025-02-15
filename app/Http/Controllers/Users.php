<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

use function Laravel\Prompts\error;

class Users extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => request('pass'),
        ]);
        return redirect('/');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $attributes = request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);
        if (Auth::attempt(['email' => $attributes['email'], 'password' => $attributes['password']])) {

            return redirect('/profile');
        }

        throw ValidationException::withMessages([
            'email' => 'Sorry, those credentials do not match.'
        ]);
    }
}
