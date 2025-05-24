<?php

namespace App\Http\Controllers\masterData;

use App\Models\AdCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdCategoryController extends Controller
{
    public function index()
    {
        $ad_categories = AdCategory::all();
        return view('masterData.ad-categories.index', [
            'ad_categories' => $ad_categories
        ]);
    }

    public function create()
    {
        return view('masterData.ad-categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required'
        ]);

        $ad_category = AdCategory::create($request->all());

        return redirect()->route('adCategory.index')->with('success', 'Ad Category added successfully.');
    }

    public function edit($id)
    {
        $ad_category = AdCategory::findOrFail($id);

        return view('masterData.ad-categories.edit', [
            'ad_category' => $ad_category
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required'
        ]);

        $ad_category = AdCategory::findOrFail($id);
        $ad_category->update($request->all());

        return redirect()->route('adCategory.index')->with('success', 'Ad Category updated successfully.');
    }

    public function destroy($id)
    {
        $ad_category = AdCategory::findOrFail($id);

        if ($ad_category) {
            $ad_category->delete();
            return response()->json(['success', 'Ad Category deleted successfully!']);
        }
    }
}
