<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="/css/app.css">
</head>
<body>

<h1>Login</h1>

<form method="POST" action="/login">
    @csrf

    <div>
        <label for="email">Email</label>
        <input type="email" name="email" id="email">
    </div>

    <div>
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
    </div>

    <button type="submit">Login</button>
</form>

</body>
</html>
