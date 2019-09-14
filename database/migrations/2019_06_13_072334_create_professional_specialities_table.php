<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfessionalSpecialitiesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('professional_specialities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('professional_id')->nullable()->unsigned();
            $table->foreign('professional_id')->references('id')->on('professional')->onDelete('cascade');
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
        Schema::dropIfExists('professional_specialities');
    }

}
