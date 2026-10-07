<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Item</title>
    <link rel="stylesheet" href="/css/app.css">
</head>
<body>

<h1>Create New Item</h1>

<form method="POST" action="/items">
    @csrf

    <div>
        <label for="brand">Brand</label>
        <input type="text" name="brand" id="brand">
    </div>

    <div>
        <label for="category">Category</label>
        <input type="text" name="category" id="category">
    </div>

    <div>
        <label for="serial_number">Serial Number</label>
        <input type="text" name="serial_number" id="serial_number">
    </div>

    <div>
        <label for="description">Description</label>
        <textarea name="description" id="description"></textarea>
    </div>

    <button type="submit">Create Item</button>
</form>

</body>
</html>
