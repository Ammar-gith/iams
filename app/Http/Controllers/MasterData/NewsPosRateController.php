<?php

namespace App\Http\Controllers\MasterData;

use App\Models\NewsPosRate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsPosRateController extends Controller
{
    //
    public function index()
    {
        $news_pos_rates = NewsPosRate::all();
        return view('masterData.news-pos-rates.index', [
            'news_pos_rates' => $news_pos_rates
        ]);
    }

    public function create()
    {
        return view('masterData.news-pos-rates.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'position' => 'required|string',
            'rates' => 'required|numeric'
        ]);

        $news_pos_rate = NewsPosRate::create($request->all());

        return redirect()->route('newsPosRate.index')->with('success', 'Newspaper position and rate added successfully');
    }


    public function edit($id)
    {
        $news_pos_rate = NewsPosRate::findOrFail($id);
        return view('masterData.news-pos-rates.edit', [
            'news_pos_rate' => $news_pos_rate
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'position' => 'required|string',
            'rates' => 'required|numeric',
        ]);

        $news_pos_rate = NewsPosRate::findOrFail($id);
        $news_pos_rate->update($request->all());

        return redirect()->route('newsPosRate.index')->with('success', 'Newspaper position and rate updated successfully.');
    }

    public function destroy($id)
    {
        $news_pos_rate = NewsPosRate::findOrFail($id);

        if ($news_pos_rate) {
            $news_pos_rate->delete();
            return response()->json(['success' => 'Newspaper position and rate deleted successfully.']);
        } else {
            return response()->json(['error', 'Data not found!']);
        }
    }
}