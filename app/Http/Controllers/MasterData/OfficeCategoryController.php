<?php

namespace App\Http\Controllers\MasterData;

use Illuminate\Http\Request;
use App\Models\OfficeCategory;
use App\Http\Controllers\Controller;

class OfficeCategoryController extends Controller
{
    public function index()
    {
        $office_categories = OfficeCategory::all();
        return view('masterData.office-categories.index', [
            'office_categories' => $office_categories
        ]);
    }

    public function create()
    {
        return view('masterData.office-categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
           'title' => 'required|string',
        ]);

        $office_category = OfficeCategory::create($request->all());
        return redirect()->route('officeCategory.index')->with('success', 'Office Category created successfully');
    }


    public function edit($id)
    {
        $office_category = OfficeCategory::find($id);
        return view('masterData.office-categories.edit',[
            'office_category' => $office_category
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string',
        ]);

        $office_category = OfficeCategory::findOrFail($id);
        $office_category->update($request->all());
        return redirect()->route('officeCategory.index')->with('success', 'Office Category updated successfully');
    }

    public function destroy($id)
    {
        $office_category = OfficeCategory::findOrFail($id);

        if($office_category){
            $office_category->delete();
            return response()->json(['success' => 'Office Category deleted successfully']);
        }else{
            return response()->json(['error' => 'Office Category not found'], 404);
        }
    }
}