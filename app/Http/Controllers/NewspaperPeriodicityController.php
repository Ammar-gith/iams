<?php

namespace App\Http\Controllers;

use App\Models\NewspaperPeriodicity;
use Illuminate\Http\Request;

class NewspaperPeriodicityController extends Controller
{
    public function index()
    {
        $newspaper_periodicities = NewspaperPeriodicity::all();

        return view('newspaper-periodicity.index', [
            'newspaper_periodicities' => $newspaper_periodicities
        ]);
    }

    public function create()
    {
        return view('newspaper-periodicity.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
        ]);

        $newspaper_periodicity = NewspaperPeriodicity::create($request->all());

        return redirect()->route('newspaperPeriodicity.index')->with('success', 'Newspaper periodicity added successfully.');
    }

    public function edit($id)
    {
        $newspaper_periodicity = NewspaperPeriodicity::findOrFail($id);

        return view('newspaper-periodicity.edit', [
            'newspaper_periodicity' => $newspaper_periodicity
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string',
        ]);

        $newspaper_periodicity = NewspaperPeriodicity::findOrFail($id);

        $newspaper_periodicity->update($request->all());

        return redirect()->route('newspaperPeriodicity.index')->with('success', 'Newspaper periodicity updated successfully.');
    }

    public function destroy($id)
    {
        $newspaper_periodicity = NewspaperPeriodicity::findOrFail($id);

        if ($newspaper_periodicity) {
            $newspaper_periodicity->delete();

            return response()->json(['success', 'Newspaper periodicity deleted successfully']);
        } else {
            return response()->json(['error', 'Data not found'], 404);
        }
    }
}
