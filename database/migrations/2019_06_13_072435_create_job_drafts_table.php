<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobDraftsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('job_drafts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->enum('type', ['one_time_project', 'ongoing_project'])->nullable();
            $table->enum('category', ['general_contractors', 'sub_contractors', 'supplier', 'professional', 'owner'])->nullable();
            $table->date('date')->nullable();
            $table->time('time')->nullable();
            $table->string('location')->nullable();
            $table->date('start')->nullable();
            $table->date('finish')->nullable();
            $table->double('budget_start')->nullable();
            $table->double('budget_end')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.                                            
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('job_drafts');
    }

}
