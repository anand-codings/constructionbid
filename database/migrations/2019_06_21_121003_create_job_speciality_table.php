<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobSpecialityTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('job_speciality', function (Blueprint $table) {
            $table->bigIncrements('id');
            //$table->enum('type',['general_contractors','sub_contractors','supplier','professional','owner'])->nullable();
            $table->string('title');
            $table->string('image_path');
            $table->boolean('is_popular')->default(0);
            $table->string('path');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('job_speciality');
    }

}
