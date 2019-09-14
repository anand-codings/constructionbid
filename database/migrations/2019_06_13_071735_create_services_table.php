<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->nullable();
            $table->double('cost_start')->nullable();
            $table->double('cost_end')->nullable();
            $table->string('location')->nullable();
            $table->longText('description')->nullable();
            $table->bigInteger('gc_id')->nullable()->unsigned();
            $table->foreign('gc_id')->references('id')->on('general_contractor')->onDelete('cascade');
            $table->bigInteger('sc_id')->nullable()->unsigned();
            $table->foreign('sc_id')->references('id')->on('sub_contractor')->onDelete('cascade');
            $table->bigInteger('supplier_id')->nullable()->unsigned();
            $table->foreign('supplier_id')->references('id')->on('supplier')->onDelete('cascade');
            $table->bigInteger('professional_id')->nullable()->unsigned();
            $table->foreign('professional_id')->references('id')->on('professional')->onDelete('cascade');
            $table->bigInteger('owner_id')->nullable()->unsigned();
            $table->foreign('owner_id')->references('id')->on('owner')->onDelete('cascade');
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
        Schema::dropIfExists('services');
    }
}
