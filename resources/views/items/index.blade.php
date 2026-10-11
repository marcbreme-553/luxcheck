<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LuxCheck Items</title>
    <link rel="stylesheet" href="/css/app.css">
</head>
<body>

<h1>LuxCheck Items</h1>

<a href="/items/create">Create New Item</a>

<form method="POST" action="/logout">
    @csrf
    <button type="submit">Logout</button>
</form>

@foreach ($items as $item)
    <div>
        <h2>{{ $item->brand }}</h2>

        <p>Category: {{ $item->category }}</p>

        <p>
            Serial Number:
            {{ $item->serial_number ?? 'No serial number' }}
        </p>

        <p>
            Owner: {{ $item->user->name }}
        </p>

        <p>
            Checks: {{ $item->checks->count() }}
        </p>

        <p>
            Media: {{ $item->media->count() }}
        </p>

        <a href="/items/{{ $item->id }}">View Item</a>

        <hr>
    </div>
@endforeach
</body>
</html>
