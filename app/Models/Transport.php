<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transport extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'gst_id',
        'address',
        'number',
        'email'
    ];
    
    public function purchase(){
        // return $this->belongsTo(Purchase::class);
        return $this->hasOne(Purchase::class);
    }

    public function sale(){
        return $this->hasOne(Sale::class, 'transport_id');
    }

    public function purchaseGrTransport(){
        return $this->hasOne(PurchaseGr::class, 'transport_id');
    }

    public function saleGrTransport(){
        return $this->hasOne(SaleGr::class, 'transport_id');
    }
}
