<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Stock;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Throw_;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Stock::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $purchase = Purchase::find($request->id);
        $stock = new Stock();
        $stock->roll_no = $request->roll_no;
        $stock->grade = $request->grade;
        $stock->meter = $request->meter;
        $stock->width = $request->width;
        $stock->weight = $request->weight;
        // $stock->purchase_client_id -> $purchase->client_id;
        // $stock->purchase_item_id -> $purchase->item_id;
        // $stock->purchase_transport_id -> $purchase->transport_id;

        try {
            $purchase->stock()->save($stock);
        } catch (Throw_ $th) {
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Stock::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function edit(Stock $stock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $stock = Stock::find($id);
        $stock->update($request->all());
        return $stock;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $stock = Stock::find($id);
        $stock->delete();
        return response('stock deleted ', 200);
    }

    public function searchStock($search_text){
        $stock = Stock::where('roll_no', $search_text)->get();
        return $stock;
    }

    public function getCurrentStock($product_name){
        
        
    }
}
