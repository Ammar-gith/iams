<?php

namespace App\Http\Controllers\MasterData;

use App\Models\Province;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProvinceController extends Controller
{
    //
    public function index()
    {
        $provinces = Province::all();

        return view('masterData.provinces.index', [
            'provinces' => $provinces
        ]);
    }


    public function create()
    {
        return view('masterData.provinces.create');
    }


    public function store(Request $request)
    {
        $validated_Data = $request->validate([
            'code' => 'required|string|max:255',
            'name' => 'required|string|max:255'
        ]);

        Province::create($validated_Data);

        return redirect()->route('province.index')->with('success', 'Province added successfully! ');
    }


    public function edit($id)
    {
        $province = Province::findOrFail($id);

        return view('masterData.provinces.edit', [
            'province' => $province
        ]);
    }


    public function update(Request $request, $id)
    {
        $province = Province::findOrFail($id);

        $validated_Data = $request->validate([
            'code' => 'required|string|max:255',
            'name' => 'required|string|max:255'
        ]);

        $province->update($validated_Data);

        return redirect()->route('province.index')->with('success', 'Province udpated successfully!');
    }


    public function destroy($id)
    {
        $province = Province::findOrFail($id);

        if ($province) {
            $province->delete();
            return response()->json(['success' => 'Province deleted successfully!']);
        } else {
            return response()->json(['error' => 'Province not found!']);
        }
    }
}