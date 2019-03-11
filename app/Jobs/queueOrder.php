<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\OrderModel;

class queueOrder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    private $orderNo;
    public function __construct($orderNo)
    {
        $this->orderNo=$orderNo;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $orderNo=$this->orderNo;
        
        $data=OrderModel::where('order_no',$orderNo);
        $check=$data->where('status_order_id',4)->count();
        // dd($check);
        if ($check) {
            $update=$data->update(['status_order_id'=>3]);
        }
    }
}
