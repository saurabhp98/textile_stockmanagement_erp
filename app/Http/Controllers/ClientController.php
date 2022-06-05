<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Throw_;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Client::all();
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
        $request ->validate([
            'name' => 'required',
            'gst_id' => 'required',
            'address'=> 'required',
            'number' => 'integer',
            'email' => 'email'
        ]);
        try {
            //code...
            return Client::create($request->all());
        } catch (Throw_ $th) {
            //throw $th;
            return $th;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         
        return Client::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $client = Client::find($id);
        $client->update($request->all());
        return $client;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $client = Client::find($id);
        $client->delete();
        return 'product been deleted';

    }

    public function searchClient($enteredText){
        $client = Client::where('name', $enteredText)
                        ->orWhere('gst_id', $enteredText)
                        ->get();
        return $client;
    }

    
    // search using keywords
    public function searchUsingKeyword($enterText){
        $delimeter = ',';
        $enteredText = explode($delimeter, $enterText);
        $client = Client::where('name', $enteredText)
                        ->orWhere('gst_id', $enteredText)
                        ->get();
        return $client;
    }
}
