<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Movie;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Show the user dashboard.
     */
    public function userDashboard()
    {
        $movies = Movie::paginate(12);
        return view('dashboard.user', compact('movies'));
    }

    /**
     * Show the admin dashboard.
     */
    public function adminDashboard()
    {
        $totalUsers = User::count();
        $verifiedUsers = User::where('is_verified', true)->count();
        $unverifiedUsers = User::where('is_verified', false)->count();

        // load movies and recent reviews for admin panel
        $movies = Movie::latest()->take(50)->get();
        $reviews = Review::latest()->with(['user', 'movie'])->take(20)->get();

        return view('dashboard.admin', compact('totalUsers', 'verifiedUsers', 'unverifiedUsers', 'movies', 'reviews'));
    }
}
