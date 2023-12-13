<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $table = 'stocks';
    protected $guarded = ['stocks'];

    public function Products(){
        return $this->hasMany('App\Models\Product');
    }
    
    public function Product(){
        return $this->belongsTo('App\Models\Product');
    }
    
    public function Units(){
        return $this->hasMany('App\Models\Unit');
    }
}
