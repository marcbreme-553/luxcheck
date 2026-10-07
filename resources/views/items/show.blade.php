<h1>{{ $item->brand }}</h1>
<link rel="stylesheet" href="/css/app.css">
<p>Category: {{ $item->category }}</p>
<p>Serial Number: {{ $item->serial_number ?? 'No serial number' }}</p>
<p>Description: {{ $item->description ?? 'No description' }}</p>
<p>Owner: {{ $item->user->name }}</p>

<h2>Checks</h2>

<form method="POST" action="/items/{{ $item->id }}/ai-check">
    @csrf
    <button type="submit">Run AI Check</button>
</form>

<a href="/items/{{ $item->id }}/checks/create">New Check</a>

@foreach ($item->checks as $check)
    <div class="card">
        <p>Status: {{ $check->status }}</p>
        <p>Confidence: {{ $check->confidence ?? 'N/A' }}</p>
        <p>{{ $check->notes }}</p>
    </div>
@endforeach

<h2>Media</h2>

<a href="/items/{{ $item->id }}/media/create">Upload Image</a>

@foreach ($item->media as $media)
    <div class="card">
        <p>{{ $media->type }}</p>

        <img
            src="{{ asset('storage/' . $media->path) }}"
            alt="{{ $media->type }}"
            width="250"
        >

        @if ($media->notes)
            <p>{{ $media->notes }}</p>
        @endif
    </div>
@endforeach

<hr>

<form method="POST" action="/items/{{ $item->id }}">
    @csrf
    @method('DELETE')

    <button type="submit">Delete Item</button>
</form>

<a href="/items">Back to all items</a>
