<?php

namespace App\Http\Controllers\MasterData;

use App\Models\TaxType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TaxTypeController extends Controller
{
    //
    public function index()
    {
        $taxTypes = TaxType::all();
        return view('masterData.tax-types.index', [
            'taxTypes' => $taxTypes
        ]);
    }

    public function create()
    {
        return view('masterData.tax-types.create');
    }

    public function store(Request $request)
    {
        $taxData = $request->all();
        TaxType::create($taxData);
        return redirect()->route('taxType.index')->with('success', 'Tax Type added successfully!');
    }

    public function edit($id)
    {
        $taxType = TaxType::findOrFail($id);
        return view('masterData.tax-types.edit', [
            'taxType' => $taxType
        ]);
    }

    public function update(Request $request, $id)
    {
        $taxType = TaxType::findOrFail($id);
        $taxType->update($request->all());
        return redirect()->route('taxType.index')->with('success', 'Tax Type updated successfully!');
    }

    public function destroy($id)
    {
        $taxType = TaxType::findOrFail($id);

        if ($taxType) {
            $taxType->delete();
            return response()->json(['success' => 'Tax Type deleted successfully.']);
        } else {
            return response()->json(['error' => 'Tax Type not found.'], 404);
        }
    }
}
