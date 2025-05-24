<?php

namespace App\Http\Controllers\masterData;

use App\Models\Language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LanguageController extends Controller
{
    public function index()
    {
        $languages = Language::all();
        return view('masterData.languages.index',[
            'languages' => $languages
        ]);
    }

    public function create()
    {
        return view('masterData.languages.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $languages = Language::create($request->all());

        return redirect()->route('language.index')->with('success', 'language added successfully.');
    }

    public function edit($id)
    {
        $language = Language::findOrFail($id);

        return view('masterData.languages.edit', [
            'language' => $language
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $language = Language::findOrFail($id);
        $language->update($request->all());

        return redirect()->route('language.index')->with('success', 'language updated successfully.');
    }

    public function destroy($id)
    {
        $language = Language::findOrFail($id);

        if ($language) {
            $language->delete();

            return response()->json(['success', 'Language deleted successfully!']);
        } else {
            return response()->json(['error', 'Language is not found']);
        }
    }
}