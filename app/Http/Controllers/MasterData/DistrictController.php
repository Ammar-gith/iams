<?php

namespace App\Http\Controllers\MasterData;

use App\Models\District;
use App\Models\Province;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DistrictController extends Controller
{
    //
    public function index()
    {
        // $districts = District::select('districts.*', 'provinces.name as province_name') // select all columns from districts table and name column from provinces table using join method
        //     ->join('provinces', 'districts.province_id', '=', 'provinces.id')
        //     ->get();

        $districts = District::with('province')->get(); // select all columns from districts table and name column from provinces table using model relationship method
        return view('masterData.districts.index', [
            'districts' => $districts,

        ]);
    }

    public function create()
    {
        $provinces = Province::all();
        return view('masterData.districts.create', [
            'provinces' => $provinces
        ]);
    }

    public function Store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'province_id' => 'required'
        ]);

        $district = District::create($request->all());

        return redirect()->route('district.index')->with('success', 'District created successfully');
    }

    public function edit($id)
    {
        $district = District::findOrFail($id);

        return view('masterData.districts.edit', [
            'district' => $district
        ]);
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'name' => 'required',
            'province_id' => 'nullable'
        ]);

        $district = District::findOrFail($id);
        $district->update($request->all());

        return redirect()->route('district.index')->with('success', 'District updated successfully');
    }

    public function destroy($id)
    {
        $district = District::findOrFail($id);
        if ($district) {
            $district->delete();
            return response()->json(['success', 'District deleted successfully']);
        } else {
            return response()->json(['error', 'District not found', 404]);
        }
    }
}
