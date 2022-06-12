<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;
    protected $fillable = [
        'inv_no',
        'inv_date',
        'challan_no',
        'challan_date',
        'lr_no',
        'client_id',
        'transport_id',
        'item_id'
        
    ];
    
    // one to may relation with client table
    public function client(){
        // return $this->hasMany(Client::class);//second parameter in hasMany would be the foreign key
        // return 'you got the client relation';
        return $this->belongsTo(Client::class);

    }

    // many to many relation with item table
    public function item(){
        // return $this->hasMany(Item::class);
        return $this->belongsToMany(Item::class);
    }

    // on to one relation with transport
    public function transport(){
        // return $this->hasOne(Transport::class);
        return $this->belongsTo(Transport::class);
    }

    public function stock() {
        return $this->hasMany(Stock::class, 'purchases_id');
    }

    public function clientName(){
        return $this->hasOne(Stock::class, 'purchase_client_id');
    }

    // public function itemName(){
    //     return $this->hasOne(Stock::class, 'purchases_item_id');
    // }

    public function trasnportName(){
        return $this->hasOne(Stock::class, 'purchase_trasnport_id');
    }
}
