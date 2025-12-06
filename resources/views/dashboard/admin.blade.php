<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-danger">
    <div class="container">
        <a class="navbar-brand" href="{{ route('admin.dashboard') }}">Admin Dashboard</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <span class="nav-link text-white">Welcome, Admin {{ Auth::user()->first_name }}!</span>
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
        <div class="col-12">
            <h1 class="mb-4">Admin — Movie Management</h1>

            <div class="d-flex justify-content-between mb-3">
                <div>
                    <a href="{{ route('movies.create') }}" class="btn btn-success">Add New Movie</a>
                </div>
                <div>
                    <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">Manage Users</a>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <strong>Movies</strong>
                </div>
                <div class="card-body p-0">
                    @if(isset($movies) && $movies->count())
                        <div class="table-responsive">
                            <table class="table table-striped mb-0">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Poster</th>
                                        <th>Title</th>
                                        <th>Year</th>
                                        <th>Genre</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($movies as $movie)
                                        <tr>
                                            <td style="width:80px;">
                                                @if($movie->poster_url)
                                                    <img src="{{ $movie->poster_url }}" alt="poster" class="img-fluid" style="max-height:60px;">
                                                @else
                                                    <span class="text-muted">N/A</span>
                                                @endif
                                            </td>
                                            <td>{{ $movie->title }}</td>
                                            <td>{{ $movie->year ?? '—' }}</td>
                                            <td>{{ $movie->genre ?? '—' }}</td>
                                            <td>
                                                <a href="{{ route('movies.edit', $movie->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                                <form action="{{ route('movies.destroy', $movie->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete movie \"'+{{ json_encode($movie->title) }}+'\"?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="p-4">
                            <p class="mb-0">No movies found. Use "Add New Movie" to create one.</p>
                        </div>
                    @endif
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <strong>Recent Reviews</strong>
                </div>
                <div class="card-body">
                    @if(isset($reviews) && $reviews->count())
                        <ul class="list-group">
                            @foreach($reviews as $review)
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">{{ $review->movie?->title ?? 'Unknown Movie' }}</div>
                                        <small class="text-muted">by {{ $review->user?->first_name ?? 'Guest' }} — {{ \Carbon\Carbon::parse($review->created_at)->diffForHumans() }}</small>
                                            <p class="mb-0 mt-2">{{ \Illuminate\Support\Str::limit($review->content, 200) }}</p>
                                    </div>
                                    <div class="d-flex gap-2">
                                        <form action="{{ route('reviews.destroy', $review->id) }}" method="POST" onsubmit="return confirm('Delete this review?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="mb-0 text-muted">No recent reviews.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>