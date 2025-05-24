<?php

namespace App\Http\Controllers\MasterData;

use Illuminate\Http\Request;
use App\Models\DepartmentCategory;
use App\Http\Controllers\Controller;

class DepartmentCategoryController extends Controller
{
    public function index()
    {
        $department_categories = DepartmentCategory::all();
        return view('masterData.department-categories.index', [
            'department_categories' => $department_categories
        ]);
    }

    public function create()
    {
        return view('masterData.department-categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required'

        ]);

        $department_categories = DepartmentCategory::create($request->all());

        return redirect()->route('departmentCategory.index')
            ->with('success', 'Department Category created successfully.');
    }

    public function edit($id)
    {
        $department_category = DepartmentCategory::find($id);
        return view('masterData.department-categories.edit', [
            'department_category' => $department_category
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required'
        ]);

        $department_category = DepartmentCategory::find($id);
        $department_category->update($request->all());

        return redirect()->route('departmentCategory.index')
            ->with('success', 'Department Category updated successfully');
    }

    public function destroy($id)
    {
        $department_category = DepartmentCategory::find($id);

        if ($department_category) {
            $department_category->delete();

            return response()->json(['success' => 'Department Category deleted successfully']);
        } else {
            return response()->json(['error' => 'Department Category not found'], 404);
        }
    }
}
