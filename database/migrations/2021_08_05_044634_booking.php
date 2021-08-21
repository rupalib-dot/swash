<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Booking extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_id');
            $table->string('order_id');
            $table->string('date');
            $table->string('car');
            $table->string('price');
            $table->string('location');
            $table->string('location_name');
            $table->string('cancelrequest')->nullable();
            $table->string('status');
            $table->string('car_plate');
            $table->string('car_brand');
            $table->string('carpark_add');
            $table->string('mobile_number');
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
       Schema::dropIfExists('booking');
    }
}
