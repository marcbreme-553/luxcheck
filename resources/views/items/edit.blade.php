<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Item</title>
    <link rel="stylesheet" href="/css/app.css">
</head>
<body>

<h1>Edit Item</h1>

<form method="POST" action="/items/{{ $item->id }}">
    @csrf
    @method('PATCH')

    <div>
        <label for="brand">Brand</label>
        <input
            type="text"
            name="brand"
            id="brand"
            value="{{ $item->brand }}"
        >
    </div>

    <div>
        <label for="category">Category</label>
        <input
            type="text"
            name="category"
            id="category"
            value="{{ $item->category }}"
        >
    </div>

    <div>
        <label for="serial_number">Serial Number</label>
        <input
            type="text"
            name="serial_number"
            id="serial_number"
            value="{{ $item->serial_number }}"
        >
    </div>

    <div>
        <label for="description">Description</label>
        <textarea
            name="description"
            id="description"
        >{{ $item->description }}</textarea>
    </div>

    <button type="submit">Save Changes</button>
</form>

</body>
</html>
