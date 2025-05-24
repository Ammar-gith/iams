<?php

namespace App\Http\Controllers\MasterData;

use App\Models\TaxPayee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TaxPayeeController extends Controller
{
    //
    public function index()
    {
        $taxPayees = TaxPayee::all();

        return view('masterData.tax-payees.index', [
            'taxPayees' => $taxPayees
        ]);
    }

    public function create()
    {
        return view('masterData.tax-payees.create');
    }

    public function store(Request $request)
    {
        $taxPayeeData = $request->all();
        TaxPayee::create($taxPayeeData);

        return redirect()->route('taxPayee.index')->with('success', 'Tax payee added successfully!');
    }

    public function edit($id)
    {
        $taxPayee = TaxPayee::findOrFail($id);

        return view('masterData.tax-payees.edit', [
            'taxPayee' => $taxPayee
        ]);
    }

    public function update(Request $request, $id)
    {
        $taxPayee = TaxPayee::findOrFail($id);
        $taxPayee->update($request->all());

        return redirect()->route('taxPayee.index')->with('success', 'Tax payee updated successfully!');
    }

    public function destroy($id)
    {
        $taxPayee = TaxPayee::findOrFail($id);

        if ($taxPayee) {
            $taxPayee->delete();
            return response()->json(['success' => 'TaxPayee deleted successfully.']);
        } else {
            return response()->json(['error' => 'TaxPayee not found.'], 404);
        }
    }
}