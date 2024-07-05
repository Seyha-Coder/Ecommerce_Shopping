<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Email Verification Mail</h1>

    Please verify your email with below link
    <a href="{{ route('user.verify', $token) }}">Click to verify your email</a>
</body>
</html>