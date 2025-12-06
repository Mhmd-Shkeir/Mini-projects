<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::latest()->paginate(20);
        return view('movies.index', compact('movies'));
    }

    public function create()
    {
        return view('movies.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'genre' => 'nullable|string|max:100',
            'year' => 'nullable|digits:4|integer',
            'duration' => 'nullable|integer|min:1',
            'poster_url' => 'nullable|url',
        ]);

        Movie::create($validated);

        return redirect()->route('admin.dashboard')->with('success', 'Movie created.');
    }

    public function edit(Movie $movie)
    {
        return view('movies.edit', compact('movie'));
    }

    public function update(Request $request, Movie $movie)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'genre' => 'nullable|string|max:100',
            'year' => 'nullable|digits:4|integer',
            'duration' => 'nullable|integer|min:1',
            'poster_url' => 'nullable|url',
        ]);

        $movie->update($validated);

        return redirect()->route('admin.dashboard')->with('success', 'Movie updated.');
    }

    public function destroy(Movie $movie)
    {
        $movie->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Movie deleted.');
    }
}
