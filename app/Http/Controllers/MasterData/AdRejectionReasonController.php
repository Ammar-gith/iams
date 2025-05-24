<?php

namespace App\Http\Controllers\MasterData;

use Illuminate\Http\Request;
use App\Models\AdRejectionReason;
use App\Http\Controllers\Controller;

class AdRejectionReasonController extends Controller
{
    public function index()
    {
        $ad_rejection_reasons = AdRejectionReason::all();
        return view('masterData.ad-rejection-reasons.index', [
            'ad_rejection_reasons' => $ad_rejection_reasons
        ]);
    }

    public function create()
    {
        return view('masterData.ad-rejection-reasons.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required'
        ]);

        AdRejectionReason::create($request->all());
        return redirect()->route('adRejectionReason.index');
    }

    public function edit($id)
    {
        $ad_rejection_reason = AdRejectionReason::find($id);
        return view('masterData.ad-rejection-reasons.edit', [
            'ad_rejection_reason' => $ad_rejection_reason
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'description' => 'required'
        ]);

        $ad_rejection_reason = AdRejectionReason::find($id);
        $ad_rejection_reason->update($request->all());
        return redirect()->route('adRejectionReason.index');
    }

    public function destroy($id)
    {
        $ad_rejection_reason = AdRejectionReason::find($id);

        if ($ad_rejection_reason) {
            $ad_rejection_reason->delete();
            return response()->json(['success' => 'Ad Rejection Reason deleted successfully/']);
        } else {
            return response()->json(['error' => 'Ad Rejection Reason not found.'], 404);
        }
    }
}
