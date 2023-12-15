<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Confirmation extends Model
{
    use HasFactory;

    protected $table = 'confirmations';
    protected $guarded = ['confirmations'];

    public function Invoices(){
        return $this->hasMany('App\Models\Invoice');
    }
    
    public function Invoice(){
        return $this->belongsTo('App\Models\Invoice');
    }
}
