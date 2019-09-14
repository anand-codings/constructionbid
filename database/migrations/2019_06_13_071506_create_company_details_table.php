<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_details', function (Blueprint $table) {
            $table->bigIncrements('id');
             $table->bigInteger('user_id')->unsigned();
             $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
             $table->string('fax_number', 191)->nullable();
             $table->string('card_holder_name', 255)->nullable();
             $table->enum('profile_type', ['residential','commercial','both']);
             $table->longText('detail')->nullable(); 
             $table->string('website')->nullable(); 
             $table->string('fb_link')->nullable(); 
             $table->string('insta_link')->nullable(); 
             $table->string('linkedin_link')->nullable(); 
             $table->string('twitter_link')->nullable(); 
             $table->boolean('service_qoute_notication')->default(0)->nullable();
             $table->boolean('review_notification')->default(0)->nullable();
             $table->longText('bio')->nullable(); 
             $table->longText('service_provided')->nullable(); 
             $table->longText('area_served')->nullable(); 
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
        Schema::dropIfExists('company_details');
    }
}
