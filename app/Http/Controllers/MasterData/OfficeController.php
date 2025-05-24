<?php

namespace App\Http\Controllers\MasterData;

use App\Models\Office;
use App\Models\Status;
use App\Models\District;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\OfficeCategory;
use App\Http\Controllers\Controller;

class OfficeController extends Controller
{
    public function index()
    {
        $offices = Office::all();
        // $offices = Office::with('officeCategory')->get();

        return view('masterData.offices.index', [
            'offices' => $offices
        ]);
    }


    public function create()
    {
        $office_categories = OfficeCategory::all();
        $departments = Department::all();
        $districts = District::all();
        $office_statuses = Office::office_status;

        return view('masterData.offices.create', [
            'office_categories' => $office_categories,
            'office_statuses' => $office_statuses,
            'departments' => $departments,
            'districts' => $districts
        ]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'office_category_id' => 'required|',
            'status_id' => 'required',
            'department_id' => 'required',
            'district_id' => 'required',
            'opening_dues' => 'required|numeric',
            'deactivation_date' => 'nullable|date',
        ]);

        Office::create($request->all());

        return redirect()->route('office.index')
            ->with('success', 'Office created successfully.');
    }

    public function edit($id)
    {
        $office = Office::findOrFail($id);
        $selected_category = $office->office_category_id;
        $selected_status = $office->status_id;
        $selected_department = $office->department_id;
        $selected_district = $office->district_id;
        $office_categories = OfficeCategory::all();
        $statuses = Status::all();
        $departments = Department::all();
        $districts = District::all();

        return view('masterData.offices.edit', [
            'office' => $office,
            'office_categories' => $office_categories,
            'statuses' => $statuses,
            'departments' => $departments,
            'districts' => $districts,
            'selected_category' => $selected_category,
            'selected_status' => $selected_status,
            'selected_department' => $selected_department,
            'selected_district' => $selected_district
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'office_category_id' => 'required|',
            'status_id' => 'required',
            'department_id' => 'required',
            'district_id' => 'required',
            'opening_dues' => 'required|numeric',
            'deactivation_date' => 'nullable|date',
        ]);

        $office = Office::findOrFail($id);
        $office->update($request->all());

        return redirect()->route('office.index')
            ->with('success', 'Office updated successfully.');
    }

    public function destroy($id)
    {
        $office = Office::findOrFail($id);

        if ($office) {
            $office->delete();
            return response()->json(['success' => 'Office deleted successfully.']);
        } else {
            return response()->json(['error' => 'Office not found.'], 404);
        }
    }
}
