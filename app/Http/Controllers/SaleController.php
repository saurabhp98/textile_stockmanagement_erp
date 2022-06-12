<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Item;
use App\Models\Sale;
use App\Models\Transport;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Throw_;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Sale::all();
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
        $item = Item::findOrFail($request->item_id); //get item
        $client = Client::findOrFail($request->client_id);//get client
        $transport = Transport::findOrFail($request->transport_id); //get transport
        $sale = new Sale(); //created new purchase instance
        $sale->inv_no = $request->inv_no; 
        $sale->inv_date = $request->inv_date;
        $sale->challan_no = $request->challan_no;
        $sale->challan_date = $request->challan_date;
        $sale->lr_no = $request->lr_no;
        // $purchase->client_id = $request->client_id; 
        // $purchase->transport_id = $request->transport_id; 
        
        $sale->saleClient()->associate($client);//associating client to the purchase 
        $sale->saleTransport()->associate($transport); //associating transport to the purchase
        
        try {
            // $item->purchase()->save($purchase);
            
            $sale->save();
            $sale->saleItem()->attach($item);//attach item to purchase many to many relation

        } catch (Throw_ $th) {
            throw $th;
        }


        return $sale;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Sale::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $sale = Sale::find($id);
        $sale->update($request->all());
        return $sale;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sale = Sale::find($id);
        $sale->delete();
        return response('deleted successfully', 200);
    }
}
