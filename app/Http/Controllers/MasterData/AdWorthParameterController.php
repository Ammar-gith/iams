<?php

namespace App\Http\Controllers\MasterData;

use Illuminate\Http\Request;
use App\Models\AdWorthParameter;
use App\Http\Controllers\Controller;

class AdWorthParameterController extends Controller
{
    //
    public function index()
    {
        $ad_worth_parameters = AdWorthParameter::all();

        return view('masterData.ad-worth-parameters.index', [
            'ad_worth_parameters' =>   $ad_worth_parameters
        ]);
    }


    public function create()
    {
        return view('masterData.ad-worth-parameters.create');
    }


    public function store(Request $request)
    {
        $validated_data = $request->validate([
            'range' => 'required|string',
            'formula' => 'required|string'
        ]);

        AdWorthParameter::create($validated_data);

        return redirect()->route('adWorthParameter.index')->with('success', 'Ad Worth Parameter added successfully.');
    }

    public function edit($id)
    {
        $ad_worth_parameter = AdWorthParameter::findOrFail($id);

        return view('masterData.ad-worth-parameters.edit', [
            'ad_worth_parameter' => $ad_worth_parameter
        ]);
    }

    public function update(Request $request, $id)
    {
        $ad_worth_parameter = AdWorthParameter::findOrFail($id);
        $validated_data = $request->validate([
            'range' => 'required|string',
            'formula' => 'required|string'

        ]);
        $ad_worth_parameter->update($validated_data);
        return redirect()->route('adWorthParameter.index')->with('success', 'Ad Worth Parameter updated successfully.');
    }

    public function destroy($id)
    {
        $ad_worth_parameter = AdWorthParameter::findOrFail($id);

        if ($ad_worth_parameter) {
            $ad_worth_parameter->delete();
            return response()->json(['success' => 'Ad Worth Parameter deleted successfully.']);
        } else {
            return response()->json(['error' => 'Ad Worth Parameter not found.'], 404);
        }
    }
}