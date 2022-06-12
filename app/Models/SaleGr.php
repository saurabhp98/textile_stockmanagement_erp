<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleGr extends Model
{
    use HasFactory;
    public function stockSaleGr(){
        return $this->hasMany(Stock::class, 'salegr_id');
    }

    public function stockClientGr(){
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function stockTransportGr(){
        return $this->belongsTo(Transport::class, 'transport_id');
    }

}
