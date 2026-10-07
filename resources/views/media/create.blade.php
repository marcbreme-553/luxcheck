<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Media</title>
    <link rel="stylesheet" href="/css/app.css">
</head>
<body>

<h1>Upload Media</h1>

<p>Item: {{ $item->brand }} - {{ $item->category }}</p>

<form method="POST"
      action="/items/{{ $item->id }}/media"
      enctype="multipart/form-data">

    @csrf

    <div>
        <label for="image">Image</label>
        <input
            type="file"
            name="image"
            id="image"
            accept="image/*"
        >
    </div>

    <div>
        <label for="type">Type</label>

        <select name="type" id="type">
            <option value="overview">Overview</option>
            <option value="logo">Logo</option>
            <option value="serial">Serial Number</option>
            <option value="hardware">Hardware</option>
            <option value="interior">Interior</option>
        </select>
    </div>

    <div>
        <label for="notes">Notes</label>
        <textarea name="notes" id="notes"></textarea>
    </div>

    <button type="submit">Upload Image</button>
</form>

</body>
</html>
