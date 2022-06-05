<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;
    
    // one to may relation with client table
    public function client(){
        return $this->hasMany(Client::class, 'id');//second parameter in hasMany would be the foreign key
    }

    // one to many relation with item table
    public function item(){
        return $this->hasMany(Item::class, 'id');
    }

    // on to one relation with transport
    public function transport(){
        return $this->hasOne(Transport::class, 'id');
    }
}
