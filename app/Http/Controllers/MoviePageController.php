<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Review;
use Illuminate\Http\Request;

class MoviePageController extends Controller
{
    /**
     * Show all movies (user-facing)
     */
    public function index()
    {
        $movies = Movie::latest()->paginate(12);
        return view('movies-public.index', compact('movies'));
    }

    /**
     * Show movie details with reviews
     */
    public function show(Movie $movie)
    {
        $reviews = $movie->reviews()->latest()->get();
        return view('movies-public.show', compact('movie', 'reviews'));
    }

    /**
     * Show add review form
     */
    public function createReview(Movie $movie)
    {
        return view('movies-public.add-review', compact('movie'));
    }

    /**
     * Store a review
     */
    public function storeReview(Request $request, Movie $movie)
    {
        $request->user() || abort(401, 'You must be logged in to leave a review.');

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'content' => 'required|string|min:10',
        ]);

        Review::create([
            'user_id' => $request->user()->id,
            'movie_id' => $movie->id,
            'title' => $validated['title'],
            'rating' => $validated['rating'],
            'content' => $validated['content'],
        ]);

        return redirect()->route('movies.show', $movie->id)->with('success', 'Review added!');
    }

    /**
     * Search movies by title or description
     */
    public function search(Request $request)
    {
        $query = $request->input('q');

        if (!$query || strlen($query) < 2) {
            return redirect()->route('movies.listing')->with('error', 'Search query must be at least 2 characters.');
        }

        $movies = Movie::where('title', 'like', "%{$query}%")
            ->orWhere('description', 'like', "%{$query}%")
            ->latest()
            ->paginate(12);

        return view('movies-public.search', compact('movies', 'query'));
    }
}
