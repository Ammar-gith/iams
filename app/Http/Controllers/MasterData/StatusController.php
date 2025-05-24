<?php

namespace App\Http\Controllers\masterData;

use App\Models\Status;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StatusController extends Controller
{
    public function index()
    {
        $statuses = Status::all();
        return view('masterData.statuses.index', [
            'statuses' => $statuses
        ]);
    }

    public function create()
    {
        return view('masterData.statuses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
        ]);

        $status = Status::create($request->all());

        return redirect()->route('status.index')->with('success', 'Status added successfully.');
    }

    public function edit($id)
    {
        $status = Status::findOrFail($id);

        return view('masterData.statuses.edit', [
            'status' => $status
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required'
        ]);

        $status = Status::findOrFail($id);
        $status->update($request->all());

        return redirect()->route('status.index')->with('success', 'Status updated successfully.');
    }


    public function destroy($id)
    {
        $status = Status::findOrFail($id);

        if ($status) {
            $status->delete();
            return response()->json(['success', 'Status deleted successfully!']);
        }
        return response()->json(['error', 'Status is not found'], 404);
    }
}