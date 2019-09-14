<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScSpecialitiesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('sc_specialities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('sc_id')->nullable()->unsigned();
            $table->foreign('sc_id')->references('id')->on('sub_contractor')->onDelete('cascade');
            $table->bigInteger('speciality_id')->nullable()->unsigned();
            $table->foreign('speciality_id')->references('id')->on('specialities')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('sc_specialities');
    }

}
