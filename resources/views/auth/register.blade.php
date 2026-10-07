<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="/css/app.css">
</head>
<body>

<h1>Create Account</h1>

<form method="POST" action="/register">
    @csrf

    <div>
        <label for="name">Name</label>
        <input type="text" name="name" id="name">
    </div>

    <div>
        <label for="email">Email</label>
        <input type="email" name="email" id="email">
    </div>

    <div>
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
    </div>

    <div>
        <label for="password_confirmation">Confirm Password</label>
        <input type="password" name="password_confirmation" id="password_confirmation">
    </div>

    <button type="submit">Register</button>
</form>

</body>
</html>
