<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSavesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('saves', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('company_id')->nullable()->unsigned();
            $table->foreign('company_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('homeowner_id')->nullable()->unsigned();
            $table->foreign('homeowner_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('job_id')->nullable()->unsigned();
            $table->foreign('job_id')->references('id')->on('jobs')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('saves');
    }

}
