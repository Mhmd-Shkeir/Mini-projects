<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Welcome to our site</h2>
    <form id="signupForm" class="needs-validation" novalidate method="POST" action="{{ route('signup.submit') }}">
        @csrf
        <div class="mb-3">
            <label for="last_name" class="form-label">Last name</label>
            <input type="text" class="form-control" id="last_name" name="last_name" required minlength="1" maxlength="255">
            <div class="invalid-feedback">Please enter your last name (max 255 characters).</div>
        </div>
        <div class="mb-3">
            <label for="first_name" class="form-label">First name</label>
            <input type="text" class="form-control" id="first_name" name="first_name" required minlength="1" maxlength="255">
            <div class="invalid-feedback">Please enter your first name (max 255 characters).</div>
        </div>
        <div class="mb-3">
            <label for="date_of_birth" class="form-label">Date of Birth</label>
            <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror" 
                   id="date_of_birth" name="date_of_birth" required 
                   max="{{ date('Y-m-d') }}" value="{{ old('date_of_birth') }}">
            @error('date_of_birth')
                <div class="invalid-feedback">{{ $message }}</div>
            @else
                <div class="invalid-feedback">Please enter your date of birth (must not be in the future).</div>
            @enderror
        </div>
        <fieldset class="mb-3">
            <legend class="col-form-label pt-0">Gender</legend>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender" id="gender_male" value="male" required>
                <label class="form-check-label" for="gender_male">Male</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender" id="gender_female" value="female">
                <label class="form-check-label" for="gender_female">Female</label>
            </div>
            <div class="invalid-feedback d-block" id="genderFeedback" style="display:none;">Please select a gender.</div>
        </fieldset>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input
                type="email"
                class="form-control @error('email') is-invalid @enderror"
                id="email"
                name="email"
                required
                value="{{ old('email') }}"
            >
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @else
                <div class="invalid-feedback">Please provide a valid email address.</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required minlength="6">
            <div class="invalid-feedback">Please provide a password (minimum 6 characters).</div>
        </div>
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required minlength="6">
            <div class="invalid-feedback" id="confirmFeedback">Please confirm your password.</div>
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
    </form>

    <hr>
    <p class="text-center">Already have an account? <a href="{{ route('login') }}">Login here</a></p>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
(function () {
    'use strict';
    const form = document.getElementById('signupForm');
    const password = document.getElementById('password');
    const confirm = document.getElementById('password_confirmation');
    const genderFeedback = document.getElementById('genderFeedback');
    const genderInputs = document.querySelectorAll('input[name="gender"]');

    function isGenderSelected() {
        return Array.from(genderInputs).some(i => i.checked);
    }

    function checkPasswordMatch() {
        if (confirm.value === '') {
            confirm.setCustomValidity(''); // let required handle empty
            return true;
        }
        if (password.value !== confirm.value) {
            confirm.setCustomValidity('Passwords do not match');
            return false;
        } else {
            confirm.setCustomValidity('');
            return true;
        }
    }

    // live check for password match
    password.addEventListener('input', checkPasswordMatch);
    confirm.addEventListener('input', checkPasswordMatch);

    form.addEventListener('submit', function (event) {
        // clear gender feedback
        if (!isGenderSelected()) {
            genderFeedback.style.display = 'block';
        } else {
            genderFeedback.style.display = 'none';
        }

        // check password match
        const passwordsOk = checkPasswordMatch();

        if (!form.checkValidity() || !isGenderSelected() || !passwordsOk) {
            event.preventDefault();
            event.stopPropagation();
            form.classList.add('was-validated');
        }
    }, false);
})();
</script>

</body>
</html>