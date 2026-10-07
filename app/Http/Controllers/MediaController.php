<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Media;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function create(Item $item)
    {
        abort_unless($item->user_id === auth()->id(), 403);

        return view('media.create', compact('item'));
    }

    public function store(Request $request, Item $item)
    {
        abort_unless($item->user_id === auth()->id(), 403);

        $validated = $request->validate([
            'image' => 'required|image|max:5120',
            'type' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        $path = $request->file('image')->store('items', 'public');

        $media = new Media();
        $media->item_id = $item->id;
        $media->path = $path;
        $media->type = $validated['type'];
        $media->notes = $validated['notes'] ?? null;

        $media->save();

        return redirect('/items/' . $item->id);
    }
}
