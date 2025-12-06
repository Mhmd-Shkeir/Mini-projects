<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $movie->title }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ route('movies.listing') }}">Movies</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <form class="d-flex ms-auto me-3" action="{{ route('movies.search') }}" method="GET">
                <input class="form-control me-2" type="search" placeholder="Search by title or description" name="q" required>
                <button class="btn btn-outline-light" type="submit">Search</button>
            </form>
            <ul class="navbar-nav">
                @if(Auth::check())
                    <li class="nav-item">
                        <span class="nav-link text-white">{{ Auth::user()->first_name }}</span>
                    </li>
                    @if(Auth::user()->isAdmin())
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.dashboard') }}">Admin</a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-light">Logout</button>
                        </form>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-4">
            @if($movie->poster_url)
                <img src="{{ $movie->poster_url }}" class="img-fluid" alt="poster">
            @else
                <div class="bg-secondary text-white d-flex align-items-center justify-content-center" style="height: 400px;">
                    <span>No Image</span>
                </div>
            @endif
        </div>
        <div class="col-md-8">
            <h1>{{ $movie->title }}</h1>
            
            <div class="mb-3">
                <strong>Year:</strong> {{ $movie->year ?? 'N/A' }}<br>
                <strong>Genre:</strong> {{ $movie->genre ?? 'N/A' }}<br>
                <strong>Duration:</strong> {{ $movie->duration ? $movie->duration . ' minutes' : 'N/A' }}<br>
            </div>

            <div class="mb-4">
                <h4>Synopsis</h4>
                <p>{{ $movie->description ?? 'No description available.' }}</p>
            </div>

            @if(Auth::check())
                <a href="{{ route('reviews.create', $movie->id) }}" class="btn btn-success">Add Review</a>
            @else
                <p class="alert alert-info"><a href="{{ route('login') }}">Login</a> to add a review</p>
            @endif
        </div>
    </div>

    <hr>

    <div class="mt-5">
        <h2 class="mb-4">Reviews ({{ $reviews->count() }})</h2>

        @if($reviews->count())
            <div class="row">
                @foreach($reviews as $review)
                    <div class="col-md-12 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ $review->title ?? 'Untitled Review' }}</h5>
                                <p class="card-text">
                                    <small class="text-muted">
                                        by <strong>{{ $review->user?->first_name ?? 'Anonymous' }}</strong>
                                        on {{ $review->created_at->format('M d, Y') }}
                                    </small>
                                </p>
                                @if($review->rating)
                                    <p class="card-text">
                                        <strong>Rating:</strong>
                                        @for($i = 0; $i < $review->rating; $i++)
                                            ⭐
                                        @endfor
                                        ({{ $review->rating }}/5)
                                    </p>
                                @endif
                                <p class="card-text">{{ $review->content }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-muted">No reviews yet. Be the first to review this movie!</p>
        @endif
    </div>

    <div class="mt-5 mb-5">
        <a href="{{ route('movies.listing') }}" class="btn btn-secondary">Back to Movies</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>