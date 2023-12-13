<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $guarded = ['products'];

    public function Categories(){
        return $this->hasMany('App\Models\Category');
    }
    
    public function Category(){
        return $this->belongsTo('App\Models\Category');
    }
    
    public function Units(){
        return $this->hasMany('App\Models\Unit');
    }
    
    public function Unit(){
        return $this->belongsTo('App\Models\Unit');
    }
    
    public function Stock(){
        return $this->belongsTo('App\Models\Stock');
    }
    
    public function Stocks(){
        return $this->hasMany('App\Models\Stock');
    }

    public function Invoices(){
        return $this->hasMany('App\Models\Invoice');
    }
    
    public function Invoice(){
        return $this->belongsTo('App\Models\Invoice');
    }
}
