<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;
    protected $fillable = [
        'roll_no',
        'grade',
        'meter',
        'width',
        'weight',
        'purchase_client_id',
        'purchase_item_id',
        'purchase_transport_id',
        'sale_id',
        
    ];
    
    public function purchase(){
        return $this->belongsTo(Purchase::class, 'purchases_id');
    }


    public function sale(){
        return $this->belongsTo(Sale::class);
    }

    public function purchaseClient(){
        return $this->belongsTo(Purchase::class, 'purchase_client_id');

    }

    // public function purchaseItem(){
    //     return $this->belongsTo(Purchase::class, 'purchases_item_id');
    // }

    public function purchaseTransport(){
        return $this->belongsTo(Purchase::class, 'purchase_transport_id');
    }

    // many to one with item table
    public function itemStock(){
        return $this->belongsTo(Item::class, 'item_id');
    }

    //many to one with purchase gr
    public function purchaseGr(){
        return $this->belongsTo(PurchaseGr::class, 'purchasegr_id');
    }

    // many to one with sale gr
    public function saleGr(){
        return $this->belongsTo(SaleGr::class, 'salegr_id');
    }
}
