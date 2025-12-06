<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Notification</title>
</head>
<body>
    <h1>Welcome!</h1>
    <p>You've signed up successfully. We're excited to have you on board!</p>
    @if(isset($user) && $user->user_token)
        <p>Please verify your email by clicking the link below:</p>
        <p><a href="{{ url('/user/verify/' . $user->user_token) }}">Verify your account</a></p>
        <p>This link will expire on {{ $user->token_expiry_date?->toDayDateTimeString() ?? 'N/A' }}.</p>
    @endif
</body>
</html>