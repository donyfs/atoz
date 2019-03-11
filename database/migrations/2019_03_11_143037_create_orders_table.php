<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('order_no');
            $table->unique('order_no');
            $table->integer('orderable_id');
            $table->string('orderable_type');
            $table->timestamps();
            $table->integer('user_id')->unsigned();
            $table->integer('status_order_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('status_order_id')->references('id')->on('status_order');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
