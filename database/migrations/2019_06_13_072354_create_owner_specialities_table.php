<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOwnerSpecialitiesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('owner_specialities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('owner_id')->nullable()->unsigned();
            $table->foreign('owner_id')->references('id')->on('owner')->onDelete('cascade');
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
        Schema::dropIfExists('owner_specialities');
    }

}
