<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('company_id', false, true);
            $table->string('brand');
            $table->bigInteger('type_id', false, true);
            $table->bigInteger('color_id', false, true);
            $table->bigInteger('tariff_id', false, true);
            $table->integer('production_year');
            $table->double('lat')->nullable();
            $table->double('lng')->nullable();
            $table->integer('mileage');
            $table->boolean('is_busy')->default(false);

            /*$table->foreign('company_id')->references('id')->on('car_companies');
            $table->foreign('type_id')->references('id')->on('car_types');
            $table->foreign('color_id')->references('id')->on('colors');
            $table->foreign('tariff_id')->references('id')->on('tariffs');*/
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cars');
    }
};
