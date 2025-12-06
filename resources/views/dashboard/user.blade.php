<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="{{ route('user.dashboard') }}">User Dashboard</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <form class="d-flex ms-auto me-3" action="{{ route('movies.search') }}" method="GET">
                <input class="form-control me-2" type="search" placeholder="Search by title or description" name="q" required>
                <button class="btn btn-outline-light" type="submit">Search</button>
            </form>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <span class="nav-link text-white">Welcome, {{ Auth::user()->first_name }}!</span>
                </li>
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-outline-light">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">
    @if(session('welcome'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('welcome') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-md-12">
            <h1 class="mb-4">Browse Movies</h1>
        </div>
    </div>

    <div class="row">
        @forelse($movies as $movie)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    @if($movie->poster_url)
                        <img src="{{ $movie->poster_url }}" class="card-img-top" alt="poster" style="height: 300px; object-fit: cover;">
                    @else
                        <div class="card-img-top bg-secondary" style="height: 300px; display: flex; align-items: center; justify-content: center;">
                            <span class="text-white">No Image</span>
                        </div>
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="{{ route('movies.show', $movie->id) }}" class="text-decoration-none">{{ $movie->title }}</a>
                        </h5>
                        <p class="card-text text-muted">{{ $movie->year ?? 'N/A' }} • {{ $movie->genre ?? 'N/A' }}</p>
                        <p class="card-text">{{ Str::limit($movie->description, 100) }}</p>
                    </div>
                    <div class="card-footer bg-white">
                        <a href="{{ route('movies.show', $movie->id) }}" class="btn btn-primary btn-sm">View Details</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <p class="text-center text-muted">No movies available.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $movies->links() }}
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>