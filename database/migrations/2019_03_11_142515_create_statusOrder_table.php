<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatusOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('status_order', function (Blueprint $table) {
            $table->increments('id');
            $table->string('status');
            $table->timestamps();
            $table->softDeletes();
        });

        DB::table('status_order')->insert(
            ['id' => '4','status' => 'Process','created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')]
            );
        DB::table('status_order')->insert(
            ['id' => '1','status' => 'Success','created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')]
            );
        DB::table('status_order')->insert(
            ['id' => '2','status' => 'Failed','created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')]
            );
        DB::table('status_order')->insert(
            ['id' => '3','status' => 'Cancelled','created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')]
            );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('status_order');
    }
}
