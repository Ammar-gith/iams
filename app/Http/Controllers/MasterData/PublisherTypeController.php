<?php

namespace App\Http\Controllers\MasterData;

use Illuminate\Http\Request;
use App\Models\PublisherType;
use App\Http\Controllers\Controller;

class PublisherTypeController extends Controller
{
    //
    public function index()
    {
        $publisherTypes = PublisherType::all();

        return view('masterData.publisher-types.index', [
            'publisherTypes' => $publisherTypes
        ]);
    }

    public function create()
    {
        return view('masterData.publisher-types.create');
    }

    public function store(Request $request)
    {
        $validated_data = $request->validate([
            'code' => 'required|string|max:255',
            'description' => 'required|string'
        ]);

        PublisherType::create($validated_data);
        return redirect()->route('publisherType.index')->with('success', 'Publisher Type added successfully!');
    }


    public function edit($id)
    {
        $publisherType = PublisherType::findOrFail($id);

        return view('masterData.publisher-types.edit', [
            'publisherType' =>  $publisherType
        ]);
    }

    public function update(Request $request, $id)
    {
        $publisherType = PublisherType::findOrFail($id);
        $validated_data = $request->validate([
            'code' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);
        $publisherType->update($validated_data);

        return redirect()->route('publisherType.index')->with('success', 'Publisher Type updated successfully!');
    }

    public function destroy($id)
    {
        $publisherType = PublisherType::findOrFail($id);

        if ($publisherType) {
            $publisherType->delete();
            return response()->json(['success' => 'Publisher Type deleted successfully.']);
        } else {
            return response()->json(['error' => 'Publisher Type not found.'], 404);
        }
    }
}