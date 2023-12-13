<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    
    protected $table = 'invoices';
    protected $guarded = ['invoices'];

    public function Products(){
        return $this->hasMany('App\Models\Product');
    }
    
    public function Product(){
        return $this->belongsTo('App\Models\Product');
    }
    
    public function Payments(){
        return $this->hasMany('App\Models\Payment');
    }
    
    public function Payment(){
        return $this->belongsTo('App\Models\Payment');
    }
}
