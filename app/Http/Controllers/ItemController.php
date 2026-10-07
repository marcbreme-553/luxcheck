<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::with(['user', 'checks', 'media'])
            ->where('user_id', auth()->id())
            ->get();

        return view('items.index', compact('items'));
    }

    public function create()
    {
        return view('items.create');
    }

    public function store(Request $request)
    {
        $item = new Item();

        $item->user_id = auth()->id();
        $item->brand = $request->brand;
        $item->category = $request->category;
        $item->serial_number = $request->serial_number;
        $item->description = $request->description;

        $item->save();

        return redirect('/items');
    }

    public function show(Item $item)
    {
        abort_unless($item->user_id === auth()->id(), 403);

        $item->load(['user', 'checks', 'media']);

        return view('items.show', compact('item'));
    }

    public function edit(Item $item)
    {
        abort_unless($item->user_id === auth()->id(), 403);

        return view('items.edit', compact('item'));
    }

    public function update(Request $request, Item $item)
    {
        abort_unless($item->user_id === auth()->id(), 403);

        $item->brand = $request->brand;
        $item->category = $request->category;
        $item->serial_number = $request->serial_number;
        $item->description = $request->description;

        $item->save();

        return redirect('/items/' . $item->id);
    }

    public function destroy(Item $item)
    {
        abort_unless($item->user_id === auth()->id(), 403);

        $item->delete();

        return redirect('/items');
    }
}
