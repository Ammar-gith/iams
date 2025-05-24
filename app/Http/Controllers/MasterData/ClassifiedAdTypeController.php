<?php

namespace App\Http\Controllers\masterData;

use Illuminate\Http\Request;
use App\Models\ClassifiedAdType;
use App\Http\Controllers\Controller;

class ClassifiedAdTypeController extends Controller
{
    public function index()
    {
        $classified_ad_types = ClassifiedAdType::all();
        return view('masterData.classified-ad-types.index',[
            'classified_ad_types' => $classified_ad_types
        ]);
    }

    public function create()
    {
        return view('masterData.classified-ad-types.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required'
        ]);

        $classified_ad_type = ClassifiedAdType::create($request->all());

        return redirect()->route('classifiedAdType.index')->with('success', 'Classified Ad Type added successfully.');
    }

    public function edit($id)
    {
        $classified_ad_type = ClassifiedAdType::findOrFail($id);

        return view('masterData.classified-ad-types.edit', [
            'classified_ad_type' => $classified_ad_type
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'type' => 'required'
        ]);

        $classified_ad_type = ClassifiedAdType::findOrFail($id);
        $classified_ad_type->update($request->all());

        return redirect()->route('classifiedAdType.index')->with('success', 'Classified Ad Type updated successfully.');
    }

    public function destroy($id)
    {
        $classified_ad_type = ClassifiedAdType::findOrFail($id);

        if ($classified_ad_type) {
            $classified_ad_type->delete();
            return response()->json(['success', 'Classified Ad Type deleted successfully!']);
        } else {
            return response()->json(['error', 'Classified Ad Type not found!'], 404);
        }
    }
}