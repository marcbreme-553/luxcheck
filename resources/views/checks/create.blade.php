<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Check</title>
    <link rel="stylesheet" href="/css/app.css">
</head>
<body>

<h1>New Authentication Check</h1>

<p>Item: {{ $item->brand }} - {{ $item->category }}</p>

<form method="POST" action="/items/{{ $item->id }}/checks">
    @csrf

    <div>
        <label for="status">Status</label>

        <select name="status" id="status">
            <option value="pending">Pending</option>
            <option value="likely authentic">Likely Authentic</option>
            <option value="suspicious">Suspicious</option>
            <option value="more images needed">More Images Needed</option>
        </select>
    </div>

    <div>
        <label for="confidence">Confidence</label>
        <input
            type="number"
            name="confidence"
            id="confidence"
            min="0"
            max="100"
            step="0.01"
        >
    </div>

    <div>
        <label for="notes">Notes</label>
        <textarea name="notes" id="notes"></textarea>
    </div>

    <button type="submit">Create Check</button>
</form>

</body>
</html>
