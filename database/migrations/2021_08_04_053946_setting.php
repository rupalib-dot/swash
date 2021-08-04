<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Setting extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setting', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('currency');
            $table->string('payment_key_1');
            $table->string('payment_key_2');
            $table->string('car_price_1');
            $table->string('car_price_2');
            $table->string('car_price_3');
            $table->string('car_trial_price_1');
            $table->string('car_trial_price_2');
            $table->string('car_trial_price_3');
            $table->string('auto_discount_1');
            $table->string('auto_discount_percent_1');
            $table->string('auto_discount_2');
            $table->string('auto_discount_percent_2');
            $table->string('loyalty_point_discount');
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
        Schema::dropIfExists('setting');
    }
}
