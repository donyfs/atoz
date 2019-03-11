<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class TransactionModel extends Model
{
	protected $table = 'transaction';
	protected $primaryKey = 'id';
	protected $fillable = ['order_no','mobile_number','price','total','transaction_type','status_order_id','user_id'];
	public $timestamps = true;


	public function setTotalAttribute($value){
		if ($this->attributes['transaction_type']==1) {
			$this->attributes['total']=$value+$value*5/100;
		} elseif ($this->attributes['transaction_type']==2) {
			$this->attributes['total']=$value+10000;
		}
	}


}
