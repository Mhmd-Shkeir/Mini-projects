<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Mail\SignupNotification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * Display a listing of the users.
     */
    public function index(Request $request)
    {
        $query = User::query();

        // Search by name (first or last)
        if ($request->filled('search_name')) {
            $searchName = $request->search_name;
            $query->where(function($q) use ($searchName) {
                $q->where('first_name', 'LIKE', "%{$searchName}%")
                  ->orWhere('last_name', 'LIKE', "%{$searchName}%");
            });
        }

        // Search by email
        if ($request->filled('search_email')) {
            $query->where('email', 'LIKE', "%{$request->search_email}%");
        }

        $users = $query->get();
        return view('users.index', compact('users'));
    }

    public function showForm()
    {
        return view('signup');
    }

    public function register(Request $request)
    {
        // backend validation rules + custom messages
        $validated = $request->validate([
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date|before_or_equal:today',
            'gender' => 'required|in:male,female',
            'email' => 'required|email|max:255',
            'password' => 'required|confirmed|min:6',
        ], [
            'last_name.required' => 'Last name is required.',
            'first_name.required' => 'First name is required.',
            'gender.required' => 'Please select a gender.',
            'gender.in' => 'Gender must be either male or female.',
            'date_of_birth.required' => 'Date of birth is required.',
            'date_of_birth.date' => 'Please enter a valid date.',
            'date_of_birth.before_or_equal' => 'Date of birth cannot be in the future.',
            'email.required' => 'Email is required.',
            'email.email' => 'Please enter a valid email address.',
            'password.required' => 'Password is required.',
            'password.confirmed' => 'Passwords do not match.',
            'password.min' => 'Password must be at least :min characters.',
        ]);

        // Prevent duplicate signup by email (extra safety in addition to validation)
        if (User::where('email', $validated['email'])->exists()) {
            // return back with validation-style error and old input
            return redirect()->route('signup.form')
                ->withErrors(['email' => 'An account with that email already exists. Please log in.'])
                ->withInput();
        }

    // create and save user (explicit assignment)
    $user = new User();
    $user->first_name = $validated['first_name'];
    $user->last_name = $validated['last_name'];
    $user->gender = $validated['gender'];
    $user->date_of_birth = $validated['date_of_birth'];
    $user->email = $validated['email'];
    $user->password = Hash::make($validated['password']);
    // ensure user_token and token_expiry_date set (model boot handles it on creating)
    $user->save();

    try {
        Mail::to($user->email)->send(new SignupNotification($user));
    } catch (\Throwable $e) {
        Log::error('Mail send error: ' . $e->getMessage(), ['exception' => $e]);
        // optionally inform the user gracefully
        return redirect()->route('home')->withErrors(['mail' => 'Verification email could not be sent.']);
    }

        // prepare welcome message
        $message = "Welcome {$validated['first_name']}, {$validated['last_name']}";

        // redirect to home and flash the welcome message
        return redirect()->route('home')->with('welcome', $message);
    }

    /**
     * Verify user token link.
     */
    public function verify($token)
    {
        $user = User::where('user_token', $token)->first();
        if (! $user) {
            return redirect()->route('home')->withErrors(['token' => 'Invalid verification token.']);
        }

        // check expiry
        if ($user->token_expiry_date && $user->token_expiry_date->isPast()) {
            return redirect()->route('home')->withErrors(['token' => 'Verification token has expired.']);
        }

        // mark as verified
        $user->is_verified = true;
        // optionally clear token
        $user->user_token = null;
        $user->token_expiry_date = null;
        $user->save();

        return redirect()->route('home')->with('welcome', "Account verified for {$user->first_name}.");
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date|before_or_equal:today',
        ], [
            'last_name.required' => 'Last name is required.',
            'first_name.required' => 'First name is required.',
            'age.required' => 'Age is required.',
            'age.integer' => 'Age must be a number.',
            'age.min' => 'Age must be at least 1.',
            'age.max' => 'Age must not be greater than 150.',
        ]);

        $user->update($validated);

        return redirect()->route('users.index')
            ->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully.');
    }

    /**
     * Display the specified user.
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }
}
