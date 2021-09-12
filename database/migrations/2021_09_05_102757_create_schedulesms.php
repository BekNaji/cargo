<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedulesms', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('shipping_id')->unsigned()->nullable();
            $table->foreign('shipping_id')->references('id')->on('shippings')->onDelete('cascade');
            
            $table->bigInteger('smsconfig_id')->unsigned()->nullable();
            $table->foreign('smsconfig_id')->references('id')->on('smsconfigs')->onDelete('cascade');
            
            $table->string('status')->default('waiting');
            $table->string('response')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedulesms');
    }
}
