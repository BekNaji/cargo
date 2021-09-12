<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranches extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('logo');
            $table->string('phone');
            $table->string('address_from');
            $table->string('address_to');
            $table->string('website');
            $table->json('options');
            $table->string('status')->default('active');

            $table->bigInteger('sender_smsconfig_id')->unsigned()->nullable();
            $table->foreign('sender_smsconfig_id')->references('id')->on('smsconfigs')->onDelele('no action');

            $table->bigInteger('receiver_smsconfig_id')->unsigned()->nullable();
            $table->foreign('receiver_smsconfig_id')->references('id')->on('smsconfigs')->onDelele('no action');

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
        Schema::dropIfExists('branches');
    }
}
