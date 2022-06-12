<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseGr extends Model
{
    use HasFactory;
    
    public function stockPurchaseGr(){
        return $this->hasMany(Stock::class, 'purchasegr_id');
    }

    public function stockClientGr(){
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function stockTransportGr(){
        return $this->belongsTo(Transport::class, 'transport_id');
    }
}
