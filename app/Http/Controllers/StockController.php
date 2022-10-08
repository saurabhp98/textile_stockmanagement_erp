<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Item;
use App\Models\Purchase;
use App\Models\Stock;
use App\Models\Transport;
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
        $item = Item::find($request->item_id);
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
            $stock->purchaseClient()->associate($purchase->client_id);
            $stock->purchaseTransport()->associate($purchase->transport_id);
            $stock->itemStock()->associate($item);
            $stock->purchase()->associate($purchase);
            $stock->save();
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

    public function searchStock($search_text)
    {
        $stock = Stock::where('roll_no', $search_text)->get();
        return $stock;
    }

    // get current stock with detail
    public function getCurrentStock()
    {
        return  Stock::where('sale_id', null)->get();
    }
    // get current stock with sale
    public function getTotalSale()
    {
        return Stock::where('sale_id', !null)->get();
    }

    // getting sum of the current stock
    public function getSumOfCurrentStock()
    {
        return Stock::where('sale_id', null)->sum('meter');
    }

    // getting sum of the sold stock
    public function getSumOfSoldStock()
    {
        return Stock::where('sale_id', '>=', 0)->sum('meter');
    }

    // getting the sort wise detail using sort and grade
    public function getStockBySort(Request $request)
    {
        return Stock::where('item_id', Item::where('item_name', $request->item_name)->first()->value('id
        '))->where('grade', $request->grade)->get();
    }




    // get the all grade sortwise;
    public function getAllGradeSortWise(Request $request)
    {
        $gradeArray = Item::where('item_name', $request->item_name)->first()->stockByItem->pluck('g
        rade')->toArray();
        return $gradeArray;
    }
    // getting sum by sort and grade wise
    public function getSumOfStockBySort($sort, $grade)
    {
        return Item::where('item_name', $sort)->first()->stockByItem->where('grade', $grade)->where('sale_id', null)->sum('meter');
    }


    // getting the sort wise details with sum of meters

    public function alldetailSortWise()
    {


        $details = collect([]);
        foreach (Item::all() as $item) {
            # code...
            $stockname = $item->item_name;
            $gradeStock = '';
            $gradeMtr = 0;
            $stockgradeWise = collect(
                []
            );
            $stockGrade = array_unique($item->stockByItem->pluck('grade')->toArray());
            foreach ($stockGrade as $stockgrade) {
                $gradeSum = $this->getSumOfStockBySort($stockname, $stockgrade);
                $gradeStock = $stockgrade;
                $gradeMtr = $gradeSum;
                $details->push([
                    'sort_name' => $stockname,
                    // 'stock_detail' => $stockgradeWise
                    'grade' => $gradeStock,
                    'mtr' => $gradeMtr
                ]);
            };
        };
        return $details;
    }


    // bulk add stock
    public function addBulkStock(Request $request)
    {
        $purchase = Purchase::find($request->purchase_id);
        $stockList =  $request->stock;
        $data = array();
        foreach ($stockList as $singleStock) {
            array_push(
                $data,
                array(
                    'roll_no' => $singleStock['roll_no'],
                    'grade' => $singleStock['grade'],
                    'meter' => $singleStock['meter'],
                    'width' => $singleStock['width'],
                    'weight' => $singleStock['weight'],
                    'item_id' => $singleStock['item_id'],
                    'purchases_id' => $purchase->id,
                    'purchase_client_id' => $purchase->client_id,
                    'purchase_transport_id' => $purchase->transport_id,
                )
            );
        }
        try {
            Stock::insert($data);
        } catch (\Throwable $th) {
            throw $th;
        }






        // ***********Add Stock Details Details*********** //
        // get Item Detail if Item in db? take its 'id' else create item and take id.


    }
}
