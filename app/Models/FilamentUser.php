<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FilamentUser extends Model
{
    use HasFactory;

    protected $table = 'filament_users';
    protected $guarded = ['filament_users'];

    public function Invoices(){
        return $this->hasMany('App\Models\Invoice');
    }
    
    public function Invoice(){
        return $this->belongsTo('App\Models\Invoice');
    }

    public function role()
    {
        return $this->belongsToMany(Role::class, 'role');
    }
}
