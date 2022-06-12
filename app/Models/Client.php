<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'gst_id', 'address', 'number', 'email'
    ];
    public function purchase(){
        // return $this->belongsToMany(Purchase::class);
        return $this->hasMany(Purchase::class);
    }

    public function sale(){
        return $this->hasMany(Sale::class, 'client_id');
    }

    public function purchaseGrClient(){
        return $this->hasMany(PurchaseGr::class, 'client_id');
    }

    public function saleGrTransport(){
        return $this->hasMany(SaleGr::class, 'transport_id');
    }

    
}
