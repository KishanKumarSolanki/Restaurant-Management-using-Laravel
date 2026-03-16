<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\MenuCategory;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Item::with('menuCategory')->orderBy('name')->paginate(10);
        return view('items.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = MenuCategory::where('is_active', true)->orderBy('name')->get();

        return view('items.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:1|max:9999.99',
            'menu_category_id' => 'required|exists:menu_categories,id',
            'description' => 'nullable|string|max:500',
            'is_available' => 'required|boolean',
        ]);

        $category = MenuCategory::findOrFail($validated['menu_category_id']);
        $validated['category'] = $category->name;

        Item::create($validated);

        return redirect()->route('items.index')->with('success', 'Item created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        return view('items.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        $categories = MenuCategory::where('is_active', true)
            ->orWhere('id', $item->menu_category_id)
            ->orderBy('name')
            ->get();

        return view('items.edit', compact('item', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:1|max:9999.99',
            'menu_category_id' => 'required|exists:menu_categories,id',
            'description' => 'nullable|string|max:500',
            'is_available' => 'required|boolean',
        ]);

        $category = MenuCategory::findOrFail($validated['menu_category_id']);
        $validated['category'] = $category->name;

        $item->update($validated);

        return redirect()->route('items.index')->with('success', 'Item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        $item->delete();

        return redirect()->route('items.index')->with('success', 'Item deleted successfully.');
    }
}
