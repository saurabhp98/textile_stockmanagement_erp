<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $fillable = [
        'item_name',
        'width',
        'shade'
    ];
    // many to many relationship with purchase
    public function purchase(){
        // return $this->belongsToMany(Purchase::class);
        return $this->belongsToMany(Purchase::class);
    }
}
