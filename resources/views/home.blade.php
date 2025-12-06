<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">Home</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                @if(Auth::check())
                    <li class="nav-item">
                        <span class="nav-link text-white">Welcome, {{ Auth::user()->first_name }}!</span>
                    </li>
                    @if(Auth::user()->isAdmin())
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.dashboard') }}">Admin Dashboard</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('user.dashboard') }}">Dashboard</a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-outline-light">Logout</button>
                        </form>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('signup.form') }}">Sign Up</a>
                    </li>
                @endif
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
            @if(Auth::check())
                <h1 class="mb-4">Welcome back, {{ Auth::user()->first_name }}!</h1>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Your Role</h5>
                                <p class="card-text">
                                    @if(Auth::user()->isAdmin())
                                        <span class="badge bg-danger">Administrator</span>
                                    @else
                                        <span class="badge bg-info">Regular User</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Account Status</h5>
                                <p class="card-text">
                                    @if(Auth::user()->is_verified)
                                        <span class="badge bg-success">Verified</span>
                                    @else
                                        <span class="badge bg-warning">Not Verified</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    @if(Auth::user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-danger btn-lg">Go to Admin Dashboard</a>
                    @else
                        <a href="{{ route('user.dashboard') }}" class="btn btn-primary btn-lg">Go to Your Dashboard</a>
                    @endif
                    <a href="{{ route('movies.listing') }}" class="btn btn-success btn-lg">Browse Movies</a>
                </div>
            @else
                <h1 class="mb-4">Welcome to Our Application</h1>
                <div class="alert alert-info">
                    <p>Please log in or sign up to access the application.</p>
                </div>

                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0">Already a member?</h5>
                            </div>
                            <div class="card-body">
                                <p>Log in to your account to access your dashboard and manage your profile.</p>
                                <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header bg-success text-white">
                                <h5 class="mb-0">New here?</h5>
                            </div>
                            <div class="card-body">
                                <p>Create a new account to get started with our application.</p>
                                <a href="{{ route('signup.form') }}" class="btn btn-success">Sign Up</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-12">
                        <a href="{{ route('movies.listing') }}" class="btn btn-info btn-lg w-100">Browse All Movies</a>
                    </div>
                </div>

                <div class="alert alert-warning mt-4">
                    <strong>Demo Credentials:</strong>
                    <ul class="mb-0">
                        <li><strong>Admin:</strong> admin@example.com / password123</li>
                        <li><strong>User:</strong> john@example.com / password123</li>
                    </ul>
                </div>
            @endif
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>