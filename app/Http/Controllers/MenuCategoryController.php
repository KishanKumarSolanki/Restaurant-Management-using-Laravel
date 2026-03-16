<?php

namespace App\Http\Controllers;

use App\Models\MenuCategory;
use Illuminate\Http\Request;

class MenuCategoryController extends Controller
{
    public function index()
    {
        $categories = MenuCategory::withCount('items')->orderBy('name')->paginate(10);

        return view('menu-categories.index', compact('categories'));
    }

    public function create()
    {
        return view('menu-categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:menu_categories,name',
            'description' => 'nullable|string|max:255',
            'is_active' => 'required|boolean',
        ]);

        MenuCategory::create($validated);

        return redirect()->route('menu-categories.index')->with('success', 'Menu category created successfully.');
    }

    public function edit(MenuCategory $menu_category)
    {
        return view('menu-categories.edit', ['category' => $menu_category]);
    }

    public function update(Request $request, MenuCategory $menu_category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:menu_categories,name,' . $menu_category->id,
            'description' => 'nullable|string|max:255',
            'is_active' => 'required|boolean',
        ]);

        $menu_category->update($validated);
        $menu_category->items()->update(['category' => $validated['name']]);

        return redirect()->route('menu-categories.index')->with('success', 'Menu category updated successfully.');
    }

    public function destroy(MenuCategory $menu_category)
    {
        $menu_category->delete();

        return redirect()->route('menu-categories.index')->with('success', 'Menu category deleted successfully.');
    }
}
