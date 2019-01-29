<?php

namespace App\Http\Controllers\Admincp;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admincp\PortfolioRequest;

use Illuminate\Http\Request;
use App\Model\Admincp\Portfolio;
use Illuminate\Support\Facades\Storage;

class PortfolioController extends Controller
{
    //
    public function index(){
        return view('admincp.portfolio');
    }

    public function showTable(){
        $portfolios = ['data' => Portfolio::all()];
        return $portfolios;
    }

    public function destroy($id) {
        Portfolio::destroy($id);
        return response()->json([
            "message" => "Success"
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function add(PortfolioRequest $request)
    {
        $portfolio = new Portfolio();
        $portfolio->name = $request->name;
        $portfolio->client = $request->client;
        $portfolio->link = $request->link;
        if ($request->hasFile('smallpic'))
        {
            $filename = str_random(10) . '.' . $request->file('smallpic')->getClientOriginalExtension();
            $request->file('smallpic')->move(public_path() . '/img/portfolio/', $filename);
            $portfolio->smallpic = $filename;
        } else {
            $portfolio->smallpic = 'nopic.jpg';
        }

        if ($request->hasFile('fullpic'))
        {
            $filename = str_random(10) . '.' . $request->file('fullpic')->getClientOriginalExtension();
            $request->file('fullpic')->move(public_path() . '/img/portfolio/', $filename);
            $portfolio->fullpic = $filename;
        } else {
            $portfolio->fullpic = 'nopic.jpg';
        }
        $portfolio->save();
        return response()->json([
            "message" => "Success"
        ]);
    }

    public function edit(PortfolioRequest $request, $id)
    {
        $portfolio = Portfolio::find($id);
        $portfolio->name = $request->name;
        $portfolio->client = $request->client;
        $portfolio->link = $request->link;
        if ($request->hasFile('smallpic'))
        {
            // delete old file before update
            if ($portfolio->smallpic != 'nopic.jpg') {
                Storage::delete(public_path() . '/img/portfolio/' . $portfolio->smallpic);
            }
            $filename = str_random(10) . '.' . $request->file('smallpic')->getClientOriginalExtension();
            $request->file('smallpic')->move(public_path() . '/img/portfolio/', $filename);
            $portfolio->smallpic = $filename;
        }

        if ($request->hasFile('fullpic'))
        {
            // delete old file before update
            if ($portfolio->smallpic != 'nopic.jpg') {
                Storage::delete(public_path() . '/img/portfolio/' . $portfolio->smallpic);
            }
            $filename = str_random(10) . '.' . $request->file('fullpic')->getClientOriginalExtension();
            $request->file('fullpic')->move(public_path() . '/img/portfolio/', $filename);
            $portfolio->fullpic = $filename;
        }

        $portfolio->save();
        return response()->json([
            "message" => "Success"
        ]);
    }

    public function getData($id)
    {
        $portfolios = Portfolio::find($id);
        return $portfolios->toJson();
    }
}
