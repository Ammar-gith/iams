<?php

namespace App\Http\Controllers;

use App\Models\Newspaper;
use Illuminate\Http\Request;

class NewspaperController extends Controller
{
    public function index()
    {
        $newspapers = Newspaper::all();
        return view('newspapers.index', [
            'newspapers' => $newspapers
        ]);
    }

    public function create()
    {
        return view('newspapers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required'
        ]);

        $newspaper = Newspaper::create($request->all());

        return redirect()->route('newspaper.index')->with('success', 'Newspaper added successfully.');
    }

    public function edit($id)
    {
        $newspaper = Newspaper::findOrFail($id);

        return view('newspapers.edit', [
            'newspaper' => $newspaper
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required'
        ]);

        $newspaper = Newspaper::findOrFail($id);
        $newspaper->update($request->all());

        return redirect()->route('newspaper.index', 'Newspaper updated successfully.');
    }

    public function destroy($id)
    {
        $newspaper = Newspaper::findOrFail($id);


        if ($newspaper) {
            $newspaper->delete();
            return response()->json(['success' => 'Newspaper deleted successfully.']);
        } else {
            return response()->json(['error', 'Data not found!'], 404);
        }
    }
}
