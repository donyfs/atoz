<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BalanceModel extends Model
{
    /**
     * Get all of the owning imageable models.
     */
    protected $table='balance';
    protected $fillable = ['mobile_number','value','total', 'created_at', 'updated_at'];
    public $timestamps = true;
	
    public function order()
    {
    	return $this->morphOne('App\OrderModel','orderable');
    }

    public function setTotalAttribute($value){
    	$this->attributes['total']=$value+$value*5/100;
    }
}