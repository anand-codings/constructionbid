<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupplierSpecialitiesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('supplier_specialities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('supplier_id')->nullable()->unsigned();
            $table->foreign('supplier_id')->references('id')->on('supplier')->onDelete('cascade');
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
        Schema::dropIfExists('supplier_specialities');
    }

}
