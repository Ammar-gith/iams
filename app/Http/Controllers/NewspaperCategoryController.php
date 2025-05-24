<?php

namespace App\Http\Controllers;

use App\Models\NewspaperCategory;
use Illuminate\Http\Request;

class NewspaperCategoryController extends Controller
{
    public function index()
    {
        $newspaper_categories = NewspaperCategory::all();

        return view('newspaper-categories.index', [
            'newspaper_categories' => $newspaper_categories
        ]);
    }

    public function create()
    {
        return view('newspaper-categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
        ]);

        $newspaper_category = NewspaperCategory::create($request->all());

        return redirect()->route('newspaperCategory.index')->with('success', 'Newspaper Category added successfully.');
    }

    public function edit($id)
    {
        $newspaper_category = NewspaperCategory::findOrFail($id);

        return view('newspaper-categories.edit', [
            'newspaper_category' => $newspaper_category
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string',
        ]);

        $newspaper_category = NewspaperCategory::findOrFail($id);
        $newspaper_category->update($request->all());

        return redirect()->route('newspaperCategory.index')->with('success', 'Newspaper Category updated successfully.');
    }

    public function destroy($id)
    {
        $newspaper_category = NewspaperCategory::findOrFail($id);

        if ($newspaper_category) {
            $newspaper_category->delete();

            return response()->json(['success', 'Newspaper category deleted successfully']);
        } else {
            return response()->json(['error', 'Newspaper category Not found'], 404);
        }
    }
}