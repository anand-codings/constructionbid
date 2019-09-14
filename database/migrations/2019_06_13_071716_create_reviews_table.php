<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('homeowner_id')->unsigned();
            $table->foreign('homeowner_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('company_id')->unsigned();
            $table->foreign('company_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('feedback')->nullable();
             $table->decimal('rating')->comment('1.0-5.0')->nullable();
             $table->string('relation')->nullable();
             $table->double('cost')->nullable();
             $table->string('month')->nullable();
             $table->string('year')->nullable();
             $table->string('first_name')->nullable();
             $table->string('last_name')->nullable();
             $table->string('email')->nullable();
             $table->string('project_address')->nullable();
             
                   
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
        Schema::dropIfExists('reviews');
    }
}
