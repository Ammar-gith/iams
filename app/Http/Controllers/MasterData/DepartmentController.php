<?php

namespace App\Http\Controllers\MasterData;

use App\Models\Status;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\DepartmentCategory;
use App\Http\Controllers\Controller;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::all();
        return view('masterData.departments.index', [
            'departments' => $departments,

        ]);
    }

    public function create()
    {
        $department_categories = DepartmentCategory::all();
        $department_statuses = Department::department_statuses;
        return view('masterData.departments.create', [
            'department_categories' => $department_categories,
            'department_statuses' => $department_statuses
        ]);
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'category_id' => 'required|exists:department_categories,id',
            'status_id' => 'required|exists:statuses,id',
        ]);

        Department::create($request->all());

        return redirect()->route('department.index')
            ->with('success', 'Department created successfully.');
    }

    public function edit($id)
    {
        $department = Department::findOrFail($id);
        $selected_category = $department->category_id;
        $selected_status = $department->status_id;
        $department_categories = DepartmentCategory::all();
        $statuses = Status::all();
        return view('masterData.departments.edit', [
            'department' => $department,
            'department_categories' =>  $department_categories,
            'statuses' => $statuses,
            'selected_category' => $selected_category,
            'selected_status' => $selected_status
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'status_id' => 'required',
        ]);

        $department = Department::findOrFail($id);

        $department->update($request->all());

        return redirect()->route('department.index')
            ->with('success', 'Department updated successfully');
    }

    public function destroy($id)
    {
        $department = Department::find($id);

        if ($department) {
            $department->delete();
            return response()->json(['success' => 'Department deleted successfully']);
        } else {
            return response()->json(['error' => 'Department not found'], 404);
        }
    }
}
