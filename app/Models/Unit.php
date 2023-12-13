<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

    protected $table = 'units';
    protected $guarded = ['units'];

    // public function Product(){
    //     return $this->belongsTo('App\Models\Product');
    // }
}
