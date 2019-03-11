<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderModel extends Model
{
    /**
     * Get all of the owning imageable models.
     */
    protected $table='orders';
    protected $fillable = ['order_no','user_id','status_order_id', 'orderable_id', 'orderable_type'];
    public $timestamps = true;

    public function orderable()
    {
        return $this->morphTo();
    }
}