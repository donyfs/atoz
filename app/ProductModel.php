<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    /**
     * Get all of the owning imageable models.
     */
    protected $table='product';
    protected $fillable = ['product','shipping_address','price', 'shipping_code', 'total'];
    public $timestamps = true;

    public function order()
    {
        return $this->morphOne('App\OrderModel','orderable');
    }

    public function setTotalAttribute($value){
    	$this->attributes['total']=$value+10000;
    }
}