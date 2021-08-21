<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Cart extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         // car_plate: car_plate, car_brand: car_brand, carpark_add: carpark_add, mobile_number:mobile_number
        Schema::create('cart', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_id');
            $table->string('location');
            $table->string('car');
            $table->string('date');
            $table->string('price');
            $table->string('location_name');
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
        Schema::dropIfExists('cart');
    }
}
