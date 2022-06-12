<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\PurchaseGr;
use App\Models\Stock;
use Illuminate\Http\Request;

class PurchaseGrController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return PurchaseGr::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $purchase = Purchase::findOrFail($request->purchase_id);
        $stock = Stock::findOrFail($request->stock_id);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PurchaseGr  $purchaseGr
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Purchase::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PurchaseGr  $purchaseGr
     * @return \Illuminate\Http\Response
     */
    public function edit(PurchaseGr $purchaseGr)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PurchaseGr  $purchaseGr
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PurchaseGr $purchaseGr)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PurchaseGr  $purchaseGr
     * @return \Illuminate\Http\Response
     */
    public function destroy(PurchaseGr $purchaseGr)
    {
        //
    }
}
