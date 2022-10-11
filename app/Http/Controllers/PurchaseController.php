<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Item;
use App\Models\Purchase;
use App\Models\Stock;
use App\Models\Transport;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Throw_;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Purchase::all();
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
        // $item = Item::findOrFail($request->item_id); //get item
        $client = Client::findOrFail($request->client_id);//get client
        $transport = Transport::findOrFail($request->transport_id); //get transport
        $purchase = new Purchase(); //created new purchase instance
        $purchase->inv_no = $request->inv_no; 
        $purchase->inv_date = $request->inv_date;
        $purchase->challan_no = $request->challan_no;
        $purchase->challan_date = $request->challan_date;
        $purchase->lr_no = $request->lr_no;
        // $purchase->client_id = $request->client_id; 
        // $purchase->transport_id = $request->transport_id; 
        
        $purchase->client()->associate($client);//associating client to the purchase 
        $purchase->transport()->associate($transport); //associating transport to the purchase
        
        try {
            // $item->purchase()->save($purchase);
            
            $purchase->save();
        // $purchase->item()->attach($item);//attach item to purchase many to many relation

        } catch (Throw_ $th) {
            throw $th;
        }


        return $purchase;
            

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // get single purchase by id
        return Purchase::find($id); 
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit(Purchase $purchase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $purchase = Purchase::find($id);
        $purchase->update($request->all());
        return $purchase;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $purchase = Purchase::find($id);
        $purchase->delete();
        return response('{$purchase} deleted successfully', 200);
    }

    public function searchPurchase(Request $request){
        $purchase = Purchase::where('inv_no', $request->search_text)
                            ->orWhere('challan_no', $request->search_text)
                            ->orWhere('lr_no', $request->search_text)->get();
        return $purchase;
    }

    public function getSortWiseDetails(){
       
     
//         $items = Item::all();
//         $gradeList = [];

//         foreach ($items as $item  ) {
//             # code...
//             $stockByitemdet = $item->stockByItem;
//             foreach ($stockByitemdet as $stockItem) {
//                 # code...
// $stocckgrade = $stockItem->grade;
// array_push($gradeList, $stocckgrade);

//             }
//         }

//         return $gradeList;

        // return Item::find(1)->stockByItem->find(1)->grade;
        // return Item::find(1)->stockByItem;

        
        // $itemarray = [];
        // // $itemarrayCollection = collect($itemarray);
        // foreach ($items as $item ) {
        //     # code...
        //     array_push($itemarray, $item->item_name );
            
            
        // }
        // return ;

        // $unique = $itemarrayCollection->unique();
        // return $itemarrayCollection->unique()->values()->all();
        // return collect($itemarray)->unique()->values()->all();
        
        

    // // $item_grade = array();
    // // for ($i=0; $i < count($item); $i++) { 
    //     $item_stock = Stock::with('itemStock', 'purchase')
    //                         ->where('grade', 'A')->get();
                        
    //     return $item_stock;
        
    // }
    }

    public function getSortWiseDetailSingle(Request $request){
    //    $item =  Item::with('stockByItem')->where('item_name', $request->sort)
    //    ->whereHas('stock_by_item', function ($query ){
    //     $query->where('grade', 'a');
    //    })
    //    ->get();
      
    //    return $item;

    return Item::with(['stockByItem' => function($stockByItem){

        $stockByItem->where('item_name', '2101');
    }])->get();
    }
}
