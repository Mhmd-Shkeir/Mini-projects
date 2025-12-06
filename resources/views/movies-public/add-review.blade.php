<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Review - {{ $movie->title }}</title>
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
                <li class="nav-item">
                    <span class="nav-link text-white">{{ Auth::user()->first_name }}</span>
                </li>
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-light">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <h1 class="mb-4">Add Review for "{{ $movie->title }}"</h1>

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Oops!</strong>
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <form method="POST" action="{{ route('reviews.store', $movie->id) }}">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Review Title</label>
            <input type="text" id="title" name="title" class="form-control @error('title') is-invalid @enderror" 
                   value="{{ old('title') }}" required>
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="rating" class="form-label">Rating</label>
            <select id="rating" name="rating" class="form-select @error('rating') is-invalid @enderror" required>
                <option value="">Select a rating...</option>
                <option value="1" {{ old('rating') == 1 ? 'selected' : '' }}>1 - Poor</option>
                <option value="2" {{ old('rating') == 2 ? 'selected' : '' }}>2 - Fair</option>
                <option value="3" {{ old('rating') == 3 ? 'selected' : '' }}>3 - Good</option>
                <option value="4" {{ old('rating') == 4 ? 'selected' : '' }}>4 - Very Good</option>
                <option value="5" {{ old('rating') == 5 ? 'selected' : '' }}>5 - Excellent</option>
            </select>
            @error('rating')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Review Content</label>
            <textarea id="content" name="content" class="form-control @error('content') is-invalid @enderror" 
                      rows="6" required>{{ old('content') }}</textarea>
            @error('content')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <small class="form-text text-muted">Minimum 10 characters</small>
        </div>

        <button type="submit" class="btn btn-primary">Submit Review</button>
        <a href="{{ route('movies.show', $movie->id) }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>