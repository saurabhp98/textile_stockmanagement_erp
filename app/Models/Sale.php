<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;
    protected $fillable =[
        'inv_no',
        'inv_date',
        'challan_no',
        'challan_date',
        'lr_no',
        'client_id',
        'transport_id',
        'item_id'
    ];

    public function saleStock(){
        return $this->hasMany(Stock::class);
    }

    public function saleClient(){
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function saleTransport(){
        return $this->belongsTo(Transport::class, 'transport_id');
    }

    public function saleItem(){
        return $this->belongsToMany(Item::class);
    }

    
}
